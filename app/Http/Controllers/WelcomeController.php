<?php namespace App\Http\Controllers;
use DB, Mail, Cart;
use Request, Session;
use Illuminate\Http\Request as ValidateRequest;
use App\Customer;
use App\ProductBuy;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$listProductNew = DB::table('products')->orderBy('id', 'DESC')->skip(0)->take(4)->get();
		$listProductHot = DB::select('SELECT * FROM products ORDER BY (price_old / price) DESC LIMIT 0, 4');
		$listIdBuys = DB::select('SELECT  product_id 
																                FROM product_buys 
																                GROUP BY product_id  
																                ORDER BY SUM(quantity) DESC 
																                LIMIT 0, 4 ');
		foreach ($listIdBuys as $key => $val) {
			if ($key == 0) {
				$listId = $val->product_id;
			}else{
				$listId .= ", $val->product_id";
			}
		}

		$listProductBuys = DB::select("SELECT * 
										FROM products 
								        join (SELECT  product_id 
																FROM product_buys 
																GROUP BY product_id  
																ORDER BY SUM(quantity) DESC  LIMIT 0, 4) as Temp 
											ON products.id = Temp.product_id 
										ORDER BY created_at DESC");
		return view('page.content.home', compact('listProductNew','listProductHot', 'listProductBuys'));
	}

	public function getProduct($id)
	{
		$listProductCate = DB::table('products')->where('cate_id', $id)->select('id', 'price_old', 'name', 'price', 'image', 'cate_id', 'alias')->paginate(10);
		$cate = DB::table('cates')->where('id', $listProductCate[0]->cate_id)->select('parent_id')->first();
		$listCate = DB::table('cates')->where('parent_id', $cate->parent_id)->get();
		$lastedProduct = DB::table('products')
							->leftjoin('cates', 'products.cate_id', '=', 'cates.id')
							->select('products.name as pName', 'cates.name as cName', 'products.image', 'products.id', 'products.price')
							->orderBy('products.id', 'DESC')
							->take(3)
							->get();

		$listBestSeller = DB::select('SELECT * FROM products ORDER BY (price / price_old) DESC LIMIT 0, 4');

		return view('page.content.category', compact('listProductCate', 'listCate', 'lastedProduct', 'listBestSeller'));
	}

	public function getDetailProduct($id)
	{
		$detailProduct = DB::table('products as p')
							->where('p.id', $id)
							->first();

		$listImage = DB::table('product_images')->select('image')->where('product_id', $id)->get();
		$relatedProduct = DB::table('products')->where('id','<>', $id)->where('cate_id', $detailProduct->cate_id)->take(4)->get();
		$listTags = DB::table('tags')->whereIn('id', explode(',', $detailProduct->tags))->get();

		return view('page.content.product', compact('detailProduct', 'listImage', 'relatedProduct', 'listTags'));
	}

	public function getContact()
	{
		return view('page.content.contact');
	}

	public function postContact(ValidateRequest $emailRequest)
	{
		$this->validate($emailRequest, 
				[
				 'name' => 'required',
				 'email' => 'required|e-mail',
				 'title' => 'required|min:10',
				 'message' => 'required'
				], 
				[
				'name.required' => 'Bạn chưa nhập tên',
				'email.required' => 'Bạn chưa nhập email',
				'title.required' => 'Bạn chưa nhập tiêu đề',
				'message.required' => 'Bạn chưa nhập nội dung',
				'email.e_mail' => 'Đại chỉ mail sai',
				'title.min' => 'Tiêu đề ít nhất 10 kí tự'
				]);
		$data = [
			'name' => $emailRequest->input('name'),
			'email' => $emailRequest->input('email'),
			'title' => $emailRequest->input('title'),
			'message' => $emailRequest->input('message'),
			];
		Mail::send('emails.mail_body',['data' => $data], function ($message) use ($data) {
		    $message->from($data['email'], $data['name']);
		    $message->sender($data['email'], $data['name']);
		
		    $message->to('teamchich26@gmail.com', 'Admin');
		
		    //$message->cc('john@johndoe.com', 'John Doe');
		    //$message->bcc('john@johndoe.com', 'John Doe');
		
		    $message->replyTo($data['email'], $data['name']);
		
		    $message->subject($data['title']);
		
		    $message->priority(3);
		
		    //$message->attach('pathToFile');
		});

		echo "<script>
			alert('Cảm ơn bạn, chúng tối đã nhận được mail và sẽ liên hệ lại với bạn sớm nhất !!');
			window.location = '".url('/')."'
		</script>";
	}

	public function getCart($id)
	{
		$productCart = DB::table('products')->where('id', $id)->first();
		Cart::add(['id' => $id, 'name' => $productCart->name, 'price' => $productCart->price, 'qty' => 1, 'options' => ['image' => $productCart->image]]);
		return redirect()->route('ShoppingCart');
	}

	public function getShoppingCart()
	{
		$total = Cart::total();
		$dataCart = Cart::content();
		return view('page.content.shopping-cart', compact('dataCart', 'total'));
	}

	public function deleteShoppingCart($id)
	{
		Cart::remove($id);
		return redirect()->route('ShoppingCart');
	}

	public function updateShoppingCart($id)
	{
		if (Request::ajax()) {
			$qty = (int)Request::get('qty');
			$urlCur = Request::get('urlCur');
			Cart::update($id, $qty);
			echo $urlCur;
		}
	}

	public function getCheckoutShoppingCart()
	{
		$shoppingCart = Cart::content();
		$total = Cart::total();
		return view('page.content.checkout', compact('shoppingCart', 'total'));
	}

	public function checkoutShoppingCart(ValidateRequest $infoRequest)
	{
		$this->validate($infoRequest, 
			[
				'firstname' => 'required',
				'lastname' => 'required',
				'email' => 'required|e-mail',
				'phone' => 'required|numeric',
				'address' => 'required',
			],
			[
				'firstname.required' => 'Bạn chưa nhập Tên',
				'lastname.required' => 'Bạn chưa nhập Họ',
				'email.required' => 'Bạn chưa nhập Email',
				'email.e_mail' => 'Bạn chưa email không đúng định dạng',
				'phone.required' => 'Bạn chưa nhập số điện thoại',
				'phone.numeric' => 'Số điện thoại phải là số',
				'address.required' => 'Bạn chưa nhập địa chỉ',
			]);

		$customer = new Customer();
		$customer->firstname = $infoRequest->firstname;
		$customer->lastname = $infoRequest->lastname;
		$customer->email = $infoRequest->email;
		$customer->phone = $infoRequest->phone;
		$customer->address = $infoRequest->address;
		$customer->noite = $infoRequest->noite;
		$customer->active = md5(uniqid());
		$customer->price = Cart::total();

		$productArr = array();
		$shoppingCart = Cart::content();

		foreach ($shoppingCart as $cart) {
			array_push($productArr, ['product' => $cart->id, 'qty' => $cart->qty]);
		}
		$customer->product = json_encode($productArr);
		if ($customer->save()) {
			$id = $customer->id;
			$customerInfo = Customer::find($id);
			$customerInfo->code = substr(strtoupper(uniqid()), 0, 6) . '-'. $id;
			$customerInfo->save();

			Mail::send('emails.mail_checkout', ['customerInfo' => $customerInfo], function ($message) use ($customerInfo) {
			    $message->from('teamchich20@gmail.com', 'Admin Shop Laravel');
			    //$message->sender('john@johndoe.com', 'John Doe');
			
			    $message->to($customerInfo->email, $customerInfo->lastname);
			
			    //$message->cc('john@johndoe.com', 'John Doe');
			    //$message->bcc('john@johndoe.com', 'John Doe');
			
			    $message->replyTo('teamchich20@gmail.com', 'Admin Shop Laravel');
			
			    $message->subject('Đơn Hàng');
			
			    $message->priority(3);
			
			    //$message->attach('pathToFile');
			});

			$message = ['level' => 'success', 'info' => 'Thông báo :', 'flash_message' => 'Đơn đặt hàng của bạn đã được ghi nhận, Bạn vui lòng chắc mail để xem mã đơn hàng <br> xin cảm ơn. Chúng tôi sẽ giao hàng cho bạn sớm nhất'];
		}else{
			$message = ['level' => 'danger', 'info' => 'Thông báo :', 'flash_message' => 'Đơn đặt hàng của bạn không thể lưu lại, <br> vui lòng kiểm tra lại'];
		}

		return redirect()->route('getCheckoutShoppingCart')->with($message);
	}

	public function getConfirmShoppingCart($id)
	{
		$customer = Customer::find($id);
		if ($customer) {
			$customer->active = 1;
			if ($customer->save()) {
				$message = ['level' => 'success', 'info' => 'Thông báo :', 'flash_message' => 'Đơn đặt hàng của bạn đã được lưu'];
				$shoppingCart = Cart::content();
				foreach ($shoppingCart as $cart) {
					$productBuy = new ProductBuy();
					$productBuy->product_id = $cart->id;
					$productBuy->quantity = $cart->qty;
					$productBuy->buy_day = date("Y-m-d");
					$productBuy->save();
				}
				Cart::destroy();
				Session::set('code_customer', $customer->code);
			}
			$message = ['level' => 'danger', 'info' => 'Thông báo :', 'flash_message' => 'Có lỗi khi xác nhận đơn hàng, vui lòng check mail'];
		}else{
			$message = ['level' => 'danger', 'info' => 'Thông báo :', 'flash_message' => 'Có lỗi khi xác nhận đơn hàng, vui lòng check mail'];
		}
		return redirect()->route('getInfoShoppingCart')->with($message);
	}

	public function getInfoShoppingCart()
	{
		if (Session::has('code_customer')) {
			$infoCustomer = DB::table('customers')->where('code', Session::get('code_customer'))->first();
			return view('page.content.info_customer', compact('infoCustomer'));
		}else{
			$message = ['level' => 'danger', 'info' => 'Thông báo :', 'flash_message' => 'Bạn chưa có thông tin đơn hàng'];
			return redirect()->route('getCheckoutShoppingCart')->with($message);
		}
	}

	public function getProductWithTag($id = 0)
	{
		$strTags = DB::table('products')->select('id', 'tags')->whereNotNull('tags')->get();
		$listId = array();
		foreach ($strTags as $listTags) {
			$arrTags = explode(',', $listTags->tags);
			foreach ($arrTags as $key => $val) {
				if ($val == $id) {
					array_push($listId, $listTags->id);
				}
			}
		}

		$listProductCate = DB::table('products')->whereIn('id', $listId)->paginate(2);
		$listBestSeller = DB::select('SELECT * FROM products ORDER BY (price / price_old) DESC LIMIT 0, 4');
		$listCate = null;
		$lastedProduct = DB::table('products')
							->leftjoin('cates', 'products.cate_id', '=', 'cates.id')
							->select('products.name as pName', 'cates.name as cName', 'products.image', 'products.id', 'products.price')
							->orderBy('products.id', 'DESC')
							->take(3)
							->get();
		return view('page.content.category', compact('listProductCate', 'listCate', 'lastedProduct', 'listBestSeller'));
	}
}
