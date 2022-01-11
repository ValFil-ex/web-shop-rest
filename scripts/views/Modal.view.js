
import View from "./View.js";

class ModalView extends View{


    constructor() {
        super();
        this.parentNode = $('.modal-body');
    }

    createView($data, $addedProduct) {
        this.parentNode.html('');
        let $message = "";
        if($data['state'] = 'OK'){
            $message = `${$addedProduct} has been added to your cart`;
        }else{
            $message = `${$addedProduct} is not available at the moment`
        }
        this.parentNode.html($message);
    }
}

export default new ModalView();
