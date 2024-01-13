<?php

namespace App\Http\Controllers;

//use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Bcrypt;
use Redirect;
class ProfileController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function profile()
    {
        $user = Auth::user();
        $pwd = DB::table('safe')->where('id',$user->id)->value('password');
        return view('profile',["user"=>$user,"pwd"=>$pwd]);
    }
    public function update_password(Request $request){
        $password = Bcrypt($request['password']);
        $user = Auth::user();
        DB::table('users')->where('id', $user->id)->update(['password'=>$password]);
        DB::table('safe')->where('id', $user->id)->update(['password'=>$request['password']]);
        return Redirect::to('/profile');
    }
    public function chnage_profile_photo(Request $request){
        $file = $request['photo'];
        $id = $request['user_id'];
        $destination = 'uploads/users/';
        $name= $destination.$id.'_'.$file->getClientOriginalName();
        $file->move($destination,$name);
        DB::table('users')->where('id', $id)->update(['photo'=>$name]);
        return "success";
    }
    public function backup(){

        
        $DbName  = env('DB_DATABASE');
        $get_all_table_query = "SHOW TABLES ";
        $result = DB::select(DB::raw($get_all_table_query));
    
        
    
    
    
        $connect = DB::connection()->getPdo();
    
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
    
        $prep = "Tables_in_$DbName";
        foreach ($result as $res){
            $tables[] =  $res[$prep];
        }
    
        $output = '';
        foreach($tables as $table)
        {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();
    
            foreach($show_table_result as $show_table_row)
            {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();
    
            for($count=0; $count<$total_row; $count++)
            {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "\nINSERT INTO $table (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }
        $file_name = date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
    
            
        }
}