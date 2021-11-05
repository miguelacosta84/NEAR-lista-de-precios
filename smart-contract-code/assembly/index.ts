import { Product, productsUnorderedMap } from './model';

export function health(): string {
  return "Ok";
}

export function addProduct(name:string, price:string, store:string, myListId:string): void {
  let id = productsUnorderedMap.length;
  id += 1;
  let product = new Product(id.toString(), name, price, store, myListId);
  productsUnorderedMap.set(id.toString(), product);
}

export function getAllProducts(): Array<Product>  {
  return productsUnorderedMap.values(0, productsUnorderedMap.length);
}

export function getAllProductsByListId(listId:string): Array<Product>  {
  let listProductsResult: Product[] = [];
  let listProducts: Product[] = productsUnorderedMap.values(0, productsUnorderedMap.length)

  for(let i = 0; i < listProducts.length; i++) {
    if (listProducts[i].myListId == listId) {
      listProductsResult.push(listProducts[i]);
    }
  }
  /*productsUnorderedMap.values(0, productsUnorderedMap.length).forEach((value, index, array) => {
    //if (value.myListId == listId) {
      //listProducts.push(value);
    //}
  });*/
  return listProductsResult;
}

export function getProduct(key:string): Product {
  let product = productsUnorderedMap.get(key);
  if(product) {
    return new Product(product.id, product.name, product.price, product.store, product.myListId);
  } else {
    return new Product("","","","","");
  }
}

export function deleteProduct(key:string): void {
  productsUnorderedMap.delete(key);
}


