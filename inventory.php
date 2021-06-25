<?php
/* 
Author: Breann Thiessen 
*/

class Inventory {
    //inventory will be stored in an array where the name is the key
    public $inventory = [];

    //initialize the inventory with the predefined items
    function __construct(){
        $fiddle = new Item('Fiddle', 1, 60, 20, 10);
        $dish = new Item('Dish', 0.1, 30, 30, 5);
        $spoon = new Item('Spoon', 0.5, 15, 5, 2);
        $this->inventory = [$fiddle, $dish, $spoon];
    }

    //get the inventory
    public function getInventory(){
        return $this->inventory;
    }

    //add and item to inventory
    public function addItem($name, $weight, $width, $length, $height){
        $item = new Item($name, $weight, $width, $length, $height);
        if(!($item->getName() && $item->getWeight() && $item->getWidth() && $item->getLength() && $item->getHeight())){
            return ['error' => 'Data is missing'];
        }
        //check if that exact item already exists. if it does throw error
        //there can be multiple items with the same name and different measurements because
        //in there are always multiple types of items that have the same name
        else if(in_array($item, $this->inventory)){
            return ['error' => 'That Item Already Exists'];
        }
        else{
            array_push($this->inventory, $item);
            return $this->inventory;
        }
    }

    //update the item in the existing inventory
    public function updateItem($name, $weight, $width, $length, $height){
        if(!($name && $weight && $width && $length && $height)){
            return ['error' => 'Data is missing'];
        }
        $index = $this->findItem($name);
        if(is_null($index)) return ['error' => 'That Item does not exist'];
        else{
            $item = $this->inventory[$index];
            $item->setWeight($weight);
            $item->setWidth($width);
            $item->setLength($length);
            $item->setHeight($height);
        }
        return $this->inventory;
    }

    //delete an item from the existing inventory
    public function deleteItem($name){
        if(!$name) return ['error' => 'Data is missing'];
        $item_index = $this->findItem($name);
        if(is_null($item_index)) return ['error' => 'That Item does not exist'];    
        else{
            unset($this->inventory[$item_index]);
            $this->inventory = array_values($this->inventory);   
        }
        return $this->inventory;
    }

    //find an item in the inventory, used to delete and update
    private function findItem($name){
        $index = 0;
        foreach($this->inventory as $item){
            if($item->name == $name) {
                return $index;
            }
            $index++;
        }
        return null;
    }
}

?>