<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 26.11.17
 * Time: 12:45
 */

namespace App\Http\Controllers;


use App\Clients\Client;
use Illuminate\Http\Request;

class Clients extends Controller
{
    /**
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * return client data or error msg
     */
    public function load(int $id)
    {
        try {
            $client = Client::load($id);

            return response()->json(['success' => $client->toArray()], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * return data all clients or error msg
     */
    public function loadAll()
    {
        try {
            $result = [];

            foreach (Client::loadAll() as $prosuct){
                $result[] = $prosuct->toArray();
            }

            return response()->json($result, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * return 200 and empty data or error msg
     */
    public function create(Request $request)
    {
        try {
            $data = $this->jsonToArray($request->getContent());
            $client = new Client();
            $client->fromArray($data)
                   ->save();

            return response()->json([], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * return 200 and empty data or error msg
     */
    public function change(Request $request, $id)
    {
        try {
            $data = $this->jsonToArray($request->getContent());
            Client::load($id)
                  ->fromArray($data)
                  ->save();

            return response()->json([], 200);
        } catch (\Error $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }


    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * return 200 and empty data or error msg
     */
    public function delete($id)
    {
        try {
            Client::delete($id);

            return response()->json([], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * return 200 and empty data or error msg
     */
    public function import(Request $request){
        $data = $this->jsonToArray($request->getContent());
        try {
            Client::import($data);

            return response()->json([], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * @param $data
     *
     * @return array|mixed
     *
     * convert json data to array data
     */
    private function jsonToArray($data)
    {
        $data = json_decode($data);
        $data = $this->objectToArray($data);
        return $data;
    }

    /**
     * @param $data
     *
     * @return array
     *
     * convert object to array recursive
     */
    private function objectToArray($data){
        if (is_array($data) || is_object($data)){
            $result = [];


            foreach ($data as $item => $value){
                $result[$item] = $this->objectToArray($value);
            }

            return $result;
        }
        return $data;
    }
}
