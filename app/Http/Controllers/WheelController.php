<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;
use App\Models\UsersLog;
use App\Models\UsersBuy;
use App\Models\Random;
use App\Models\Wheel;
use Session;
use Auth;

class Element
{
    /**
     * @var  $data
     */
    private $data;
    /**
     * @var float $weight
     */
    private $weight;
    /**
     * @param       $data
     * @param float $weight
     *
     * @throws InvalidWeightException
     */
    public function __construct($data, $weight = 1.0) {
        $this->data = $data;
        $this->weight = $weight;
        if($weight < 0) {
            throw new InvalidWeightException("Weight is invalid: must be greater or equal than 0.");
        }
    }
    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }
}

class Randomizer
{
    /**
     * @var array $elements
     */
    private $elements = array();
    /**
     * @param $method
     * @param $params
     *
     * @return $this
     * @throws \Exception
     */
    function __call($method, $params)
    {
        if ($method == 'add') {
            if (count($params) < 1) {
                throw new \Exception('Element parameter is required');
            }
            if ($params[0] instanceof Element) {
                return $this->addElement($params[0]);
            } else {
                $weight = isset($params[1]) && is_numeric($params[1]) ? $params[1] : 1;
                $element = new Element($params[0], $weight);
                return $this->addElement($element);
            }
        }
        throw new \Exception(sprintf("Unknown method: %s", $method));
    }
    /**
     * @return mixed
     */
    public function get()
    {
        $total = $this->getTotalWeight();
        $random = mt_rand(0, $total);
        foreach ($this->elements as $element) {
            $random -= $element->getWeight();
            if ($random <= 0) {
                return $element->getData();
            }
        }
        return $this->elements[rand(0, count($this->elements) - 1)]->getData();
    }
    /**
     * @param $data
     *
     * @return float
     */
    public function getProbabilityFor($data)
    {
        $found = null;
        array_map(function ($element) use ($data, &$found) {
                if ($element->getData() === $data) {
                    $found = $element;
                }
            },
            $this->elements);
        if ($found !== null) {
            return $found->getWeight() / $this->getTotalWeight();
        }
        return 0.0;
    }
    /**
     * @param Element $element
     *
     * @throws Exception
     * @return $this
     */
    protected function addElement($element)
    {
        if($element->getData() == null) {
            throw new Exception("Invalid Element data: null is not allowed.");
        }
        if ($this->elementExistsWith($element->getData())) {
            $this->addWeightToExisting($element);
        } else {
            $this->elements[] = $element;
        }
        return $this;
    }
    /**
     * @return float
     */
    private function getTotalWeight()
    {
        $total = 0.0;
        array_map(function ($element) use (&$total) {
                $total += $element->getWeight();
            },
            $this->elements);
        return $total;
    }
    /**
     * @param $data
     *
     * @return bool
     */
    private function elementExistsWith($data)
    {
        $found = null;
        array_map(function ($element) use ($data, &$found) {
            if ($element->getData() === $data) {
                $found = $element;
            }
        }, $this->elements);
        return $found !== null;
    }
    /**
     * @param Element $newElement
     */
    private function addWeightToExisting(Element $newElement)
    {
        $elements = $this->elements;
        array_map(function ($existingElement, $index) use (&$elements, &$newElement) {
            if ($existingElement->getData() === $newElement->getData()) {
                $newWeight = $existingElement->getWeight() + $newElement->getWeight();
                $elements[$index] = new Element($existingElement->getData(), $newWeight);
            }
        }, $elements, array_keys($elements));
        $this->elements = $elements;
    }
}


class WheelController extends Controller
{

    public function index(Request $req){   

	   return view('user/vongquay/index');
    	

    }



    public function wheel50(Request $req){   

       return view('user/vongquay/wheel50');
        

    }



    public function wheel20(Request $req){   

       return view('user/vongquay/wheel20');
        

    }



    public function load(Request $req){   

        if(!Auth::check()){
            echo json_encode(array("status" => "LOGIN"));
        }else if(Auth::user()->locked == 1){
            echo json_encode(array("msg" => "Bạn đã bị khóa giao dịch", "status" => "ERROR"));
        }else if(Auth::user()->point < 1){
            echo json_encode(array("msg" => "Bạn không đủ lượt quay, hãy mua thêm", "status" => "ERROR"));
        }else{

            $randomizer = new Randomizer();
            $randomizer->add( new Element('4', 100));
            $post = $randomizer->get(); 
            $name = array(4 => "Tích lũy thêm 10% may mắn", 1 => "Chúc bạn may mắn lần sau ^^", 3 => "Bạn đã nhận được 20K vào tài khoản trên web, hãy kiểm tra lịch sử giao dịch", 7 => "Bạn đã quay trúng tài khoản trắng thông tin, hãy kiểm tra mục tài khoản đã mua");

            Users::where('user_id',Auth::user()->user_id)->update(['point'=>Auth::user()->point - 1]);

            echo json_encode(
                array("msg" => array("name" => $name[$post], "pos" => $post, "num_roll_remain" => Auth::user()->point, "status" => "OK"))
            );
        
       }

    }


    public function load50(Request $req){   

        if(!Auth::check()){
            echo json_encode(array("status" => "LOGIN"));
        }else if(Auth::user()->locked == 1){
            echo json_encode(array("msg" => "Bạn đã bị khóa giao dịch", "status" => "ERROR"));
        }else if(Auth::user()->point_50 < 1){
            echo json_encode(array("msg" => "Bạn không đủ lượt quay, hãy mua thêm", "status" => "ERROR"));
        }else{

            $randomizer = new Randomizer();
            $randomizer->add( new Element('1', 100));
            $post = $randomizer->get(); 
            $name = array(4 => "Tích lũy thêm 30% may mắn", 1 => "Chúc bạn may mắn lần sau ^^", 3 => "Bạn đã nhận được 20K vào tài khoản trên web, hãy kiểm tra lịch sử giao dịch", 7 => "Bạn đã quay trúng tài khoản trắng thông tin, hãy kiểm tra mục tài khoản đã mua");

            Users::where('user_id',Auth::user()->user_id)->update(['point_50'=>Auth::user()->point_50 - 1]);

            echo json_encode(
                array("msg" => array("name" => $name[$post], "pos" => $post, "num_roll_remain" => Auth::user()->point_50, "status" => "OK"))
            );
        
       }

    }


    public function load20(Request $req){   

        if(!Auth::check()){
            echo json_encode(array("status" => "LOGIN"));
        }else if(Auth::user()->locked == 1){
            echo json_encode(array("msg" => "Bạn đã bị khóa giao dịch", "status" => "ERROR"));
        }else if(Auth::user()->point_20 < 1){
            echo json_encode(array("msg" => "Bạn không đủ lượt quay, hãy mua thêm", "status" => "ERROR"));
        }else{

            $randomizer = new Randomizer();
            $randomizer->add( new Element('4', 100));
            $post = $randomizer->get(); 
            $name = array(4 => "Tích lũy thêm 30% may mắn", 1 => "Chúc bạn may mắn lần sau ^^", 3 => "Bạn đã nhận được 20K vào tài khoản trên web, hãy kiểm tra lịch sử giao dịch", 7 => "Bạn đã quay trúng tài khoản trắng thông tin, hãy kiểm tra mục tài khoản đã mua");

            Users::where('user_id',Auth::user()->user_id)->update(['point_20'=>Auth::user()->point_20 - 1]);

            echo json_encode(
                array("msg" => array("name" => $name[$post], "pos" => $post, "num_roll_remain" => Auth::user()->point_20, "status" => "OK"))
            );
        
       }

    }

    public function buy(Request $req){

        if(!Auth::check()){
            return redirect()->route('login_user');
        }else if(Auth::user()->locked == 1){
             return redirect()->back()->with('err','Tài khoản bị khóa !');
        }else if(Auth::user()->cash < 50000){
            return redirect()->back()->with('err','Bạn không đủ tiền để mua, hãy nạp thêm');     
        }else{

            $cash = Auth::user()->cash - 50000; 
            Users::where('user_id',Auth::user()->user_id)->update(['cash'=>$cash,'point'=>Auth::user()->point + 1]);
          
            $log = new UsersLog();
            $log->user_id = Auth::user()->user_id;
            $log->trade_type = 9;
            $log->amount = 50000;
            $log->content = 'Mua 1 lượt quay';
            $log->last_amount = (int)$cash;
            $log->status = 1;
            $log->add_time = time();
            $log->domain = 'sh0phano.com';
            $log->save();

            return redirect()->back()->with('success','Bạn đã mua 1 lượt quay thành công !');   

        }


    }


    public function buy20(Request $req){

        if(!Auth::check()){
            return redirect()->route('login_user');
        }else if(Auth::user()->locked == 1){
             return redirect()->back()->with('err','Tài khoản bị khóa !');
        }else if(Auth::user()->cash < 20000){
            return redirect()->back()->with('err','Bạn không đủ tiền để mua, hãy nạp thêm');     
        }else{

            $cash = Auth::user()->cash - 20000; 
            Users::where('user_id',Auth::user()->user_id)->update(['cash'=>$cash,'point_20'=>Auth::user()->point_20 + 1]);
          
            $log = new UsersLog();
            $log->user_id = Auth::user()->user_id;
            $log->trade_type = 9;
            $log->amount = 20000;
            $log->content = 'Mua 1 lượt quay';
            $log->last_amount = (int)$cash;
            $log->status = 1;
            $log->add_time = time();
            $log->domain = 'sh0phano.com';
            $log->save();

            return redirect()->back()->with('success','Bạn đã mua 1 lượt quay thành công !');   

        }


    }




    public function buy50(Request $req){

        if(!Auth::check()){
            return redirect()->route('login_user');
        }else if(Auth::user()->locked == 1){
             return redirect()->back()->with('err','Tài khoản bị khóa !');
        }else if(Auth::user()->cash < 50000){
            return redirect()->back()->with('err','Bạn không đủ tiền để mua, hãy nạp thêm');     
        }else{

            $cash = Auth::user()->cash - 50000; 
            Users::where('user_id',Auth::user()->user_id)->update(['cash'=>$cash,'point_50'=>Auth::user()->point_50 + 1]);
          
            $log = new UsersLog();
            $log->user_id = Auth::user()->user_id;
            $log->trade_type = 9;
            $log->amount = 50000;
            $log->content = 'Mua 1 lượt quay';
            $log->last_amount = (int)$cash;
            $log->status = 1;
            $log->add_time = time();
            $log->domain = 'sh0phano.com';
            $log->save();

            return redirect()->back()->with('success','Bạn đã mua 1 lượt quay thành công !');   

        }


    }




}


