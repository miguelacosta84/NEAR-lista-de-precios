import { PersistentUnorderedMap } from "near-sdk-as";

@nearBindgen
export class Product {  
  id: string;
  name: string;
  price: string;
  store: string;
  myListId:string;

  constructor(id:string, name: string, price: string, store: string, myListId:string) {    
    this.id = id;
    this.name = name;
    this.price = price;
    this.store = store;
    this.myListId = myListId;
  }
}

export const productsUnorderedMap = new PersistentUnorderedMap<string, Product>("v");