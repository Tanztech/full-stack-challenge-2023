<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    private array $data = [];

    /*
     * search_param['index'=> $value1]
     *
     */
    private function search($data,$str_search ): array
    {
        if (strtolower($str_search) == ""){
            $this->data = $data;
        }else{
            foreach ($data as $item) {
                foreach ($item as $value) {
                    if (is_array($value)){
                        foreach ($value as $value_data){
                            if (is_array($value_data)){
                                foreach ($value_data as $arraydata){
                                    if (is_array($arraydata)){
                                        foreach ($arraydata as $dtArray){
                                            if (is_array($dtArray)){
                                                foreach ($dtArray as $dt){
                                                    if (is_array($dt)){
                                                        foreach ($dt as $d_dt_data){
                                                            if (str_contains(strtolower($d_dt_data), strtolower($str_search))) {
                                                                $this->data[] = $item;
                                                                break 6;
                                                            }
                                                        }
                                                    }else{
                                                        if (str_contains(strtolower($dt), strtolower($str_search))) {
                                                            $this->data[] = $item;
                                                            break 5;
                                                        }
                                                    }
                                                }
                                            }else{
                                                if (str_contains(strtolower($dtArray), strtolower($str_search))) {
                                                    $this->data[] = $item;
                                                    break 4;
                                                }
                                            }

                                        }
                                    }else{
                                        if (str_contains(strtolower($arraydata), strtolower($str_search))) {
                                            $this->data[] = $item;
                                            break 3;
                                        }
                                    }

                                }
                            }else{
                                if (str_contains(strtolower($value_data), strtolower($str_search))) {
                                    $this->data[] = $item;
                                    break 2;
                                }
                            }
                        }
                    }else{
                        if (str_contains(strtolower($value), strtolower($str_search))) {
                            $this->data[] = $item;
                            break;
                        }
                    }

                }
            }
        }

        return $this->data;
    }

    public static function searchData($data,$str_search):array{
        return (new SearchController)->search($data,strtolower($str_search));
    }

    /*
     * SORT ASC/DESC
     *
     */

    private function Sort($data,$sort,$SortKey):array{
        if (strtolower($sort) !== "asc"){
//            sort desc
            $this->data = collect($data)->sortByDesc($SortKey)->toArray();
        }
        else{
//            sort asc
            $this->data = collect($data)->sortBy($SortKey)->toArray();
        }
        return  $this->data;
    }





    public static function sortData($data,$sort,$SortKey):array{
        return (new SearchController)->Sort($data,$sort,$SortKey);
    }
}
