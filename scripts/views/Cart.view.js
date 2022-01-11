import View from './View.js';
class CartView extends View{


    constructor() {
        super();
        this.parentNode = $('#cart');
    }

    createView($data) {
        let self = this;
        self.parentNode.html('');
        let $totalPrice = 0;

        if($data['cart'].length === 0){
            $('.cart-items').html('').html('your cart is empty');
        }

        $.each($data['cart'], function($row, $product){
            let $sumPerProduct = $product['amount'] * $product["price"];
            let $totalPerProductPrice = Math.round($sumPerProduct *100)/100;

            let $markup = `<tr>
                <th scope="row">${$row+1}</th>
                <td class="cart-product-name">${$product['articleName']}</td>
                <td class="cart-product-qty">${$product['amount']}</td>
                <td class="cart-product-price">${$product["price"]} EUR</td>
                <td class="cart-total-price">${$totalPerProductPrice} EUR</td>
                <td class="cart-action" id="${$product["pid"]}">
                <button type="button" class="btn btn-success  mx-2 increase-qty" >+</button><button type="button" class="btn btn-danger decrease-qty">-</button></td>
            </tr>`;

            self.parentNode.append($markup);
            $totalPrice += $totalPerProductPrice;
        });

        let $roundedTotal = Math.round($totalPrice *100)/100;
        $('.total-order-price').html($roundedTotal+" EUR");

    }
}

export default new CartView();
