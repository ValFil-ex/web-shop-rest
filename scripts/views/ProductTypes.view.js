import View from './View.js';

class ProductTypesView extends View{

    constructor(){
        super();
        this.parentNode = $('#productTypes');
    }


    createView($data){
        let self = this;
        $.each($data, function(row, $product){
            let $productType = $product['productType'].toUpperCase();
            let $markup = `<a id="${$product['productType']}" href="${$product['url']}" class="list-group-item list-group-item-action productCategory" >${$productType}</a>`;
            self.parentNode.append($markup);
        });
    }

}

export default new ProductTypesView();
