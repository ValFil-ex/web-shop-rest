/*
*query for products in API was extended to include data description, price, volume
*/
import View from './View.js';

class ProductsView extends View{

    constructor(){
        super();
        this.parentNode = $('#products');
    }

    createView($data){
        this.parentNode.html('');
        let self = this;

        $.each($data, function($row, $product){
            let $trimmedProductName = $product['productName'].toLowerCase();
            let $productName = $trimmedProductName.charAt(0).toUpperCase() + $trimmedProductName.slice(1);
            let $markup = `<tr>
                <th scope="row">${$row+1}</th>
                <td>
                <div class="row product-info">
                    <div class="col-md-12 mb-2">
                        <h6 class="font-weight-bolder product-name ${$product["pid"]}">${$productName}</h6>
                    </div>
                    <div class="col-md-2 product-image">
                        <img src="assets/dummy_product.jpeg" width="100" class="product-image">
                    </div>
                    <div class="col-md-10 text-muted my-auto">
                         <p> Product description:</p>
                         <p class="product-description">${$product["productDescription"]}</p>
                         <p class="product-volume">${$product["baseUnit"]}</p>
                     </div>
                </div>
                </td>
                <td class="product-price">${$product["productPrice"]} EUR</td>
                <td>
                    <button type="button" class="btn btn-success add-to-cart"   id="${$product["pid"]}">Add</button>
                </td>
            </tr>`;

            self.parentNode.append($markup);
        });

    }

}

export default new ProductsView();
