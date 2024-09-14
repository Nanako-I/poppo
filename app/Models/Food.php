<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
   use HasFactory;
    protected $table = 'food';
    protected $fillable = ['people_id','lunch','lunch_bikou','oyatsu','oyatsu_bikou','food','staple_food','side_dish','medicine','medicine_name','bikou'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
    
    public function updateFood($request)
    {
        // $updateResult = $this->update([
        //     'food' => $request->food,
        //     'staple_food' => $request->staple_food,
        //     'side_dish' => $request->side_dish,
        //     'medicine' => $request->medicine,
        //     'medicine_name' => $request->medicine_name,
        //     'bikou' => $request->bikou,
            
        // $lastFood = Food::find($request->id);
        // $lastFood->staple_food   = $request->staple_food;
        // $lastFood->side_dish   = $request->side_dish;
        // $lastFood->medicine   = $request->medicine;
        // $lastFood->medicine_name   = $request->medicine_name;
        // $lastFood->bikou   = $request->bikou;
        // $lastFood->save();
    //   $food->update([
    //     'staple_food' => $request->staple_food,
    //     'side_dish' => $request->side_dish,
    //     'medicine' => $request->medicine,
    //     'medicine_name' => $request->medicine_name,
    //     'bikou' => $request->bikou,
    // ]);
        
        // ]);
        
    //     if ($updateResult) {
    //         // dd ($updateResult);
    // //     $this->save();
    // // } else {
    //     // 更新が成功しなかった場合の処理
    //     // エラーをログに記録したり、ユーザーをリダイレクトしたり、他のアクションを実行したりできます
    // }
    }
    
//     public function updateFood($request, $food)
//     {
//         $result = $food->fill([
//             'staple_food' => $request->staple_food,
//             'side_dish' => $request->side_dish,
//             'medicine' => $request->medicine,
//             'medicine_name' => $request->medicine_name,
//             'bikou' => $request->bikou
//         ])->save();

//         return $result;
//     }
}