import {health, addProduct, getProduct, deleteProduct, 
  getAllProducts, getAllProductsByListId } from '../index'
import { Product } from '../model';

describe("health", () => {
  it("Should return Ok", () => {
    expect(health()).toStrictEqual("Ok");
  });
  });

/*describe("addProduct", () => {
  it("Should save the product in storage", () => {   
    expect(addProduct("Leche","22","Walmart","5")).toBe();
  });
});*/

/*describe("getProduct", () => {
  it("Should return a product, if it doesn't exist a product without data will be returned", () => {
    expect(getProduct("1")).toStrictEqual(Product);
  });
});*/

/*describe("deleteProduct", () => {
  it("Should delete a product of storage", () => {
    expect(deleteProduct("")).toStrictEqual();
  });
});*/

/*describe("getAllProducts", () => {
  it("Should return a list of products", () => {
    //addProduct("Pan","22","Walmart","1");
    expect(getAllProducts()).toHaveLength(0);
  });
});*/

/*describe("getAllProductsByListId", () => {
  it("Should save the product in storage", () => {
    expect(getAllProductsByListId("")).toStrictEqual([]);
  });
});*/
