/*
* productsData contains several methods to fetch data with ajax calls from API
* productData class aggregates several 'View' objects which can render separate views (product types, products and cart view) once data is fetched
* every ajax call's done() methods invokes createView() method on one of the view objects injected in the class
* thus controller just steers handler events
*/
import productsData from "./models/productsData.js";


class GUIcontroller{

    constructor(){
    }

    initGUI(){
        //since i build products catalogue view and cart view on different pages, this logic is designed to decide what view is to render upon loading of a respective page


        $('body').on('click', '.shopping-view-link', (e)=>{
            productsData.renderProductTypesView();
            $('.shoppingView-container').removeClass('d-none');
            $('.cart-view-container').addClass('d-none');
        });

        $('body').on('click', '.cart-view-link', (e)=>{
            productsData.renderCartView();
            $('.cart-view-container').removeClass('d-none');
            $('.shoppingView-container').addClass('d-none');
        });


        //handler for productsView rendering
        $('body').on('click', '.productCategory', (e)=>{
            e.preventDefault();

            $('.productsViewContainer').removeClass('d-none');
            $('a').removeClass('active');
            $(e.currentTarget).addClass('active');
            let selectedUrl = $(e.currentTarget).attr('href');
            productsData.renderProductsView(selectedUrl);

            return false;

        });

         //handler for add to cart + render modal (from products view page)
         $('body').on('click', '.add-to-cart', (e)=>{
             $(".modal-body").html("");
             let $selectedID = $(e.currentTarget).attr('id');
             let $addedProduct = document.getElementsByClassName($selectedID)[0].innerText;
             productsData.addToCartAndRenderModal($selectedID, $addedProduct);
             $("#cartModal").modal('show');
             console.log($selectedID);
             e.preventDefault();
         });

        //handler to add items in the cart (from cart view page)
         $('body').on('click', '.increase-qty', (e)=>{
             let $productIdToAdd = $(e.currentTarget).parent().attr('id');
             productsData.addItemToCart($productIdToAdd);
             productsData.renderCartView();
             e.preventDefault();
         });

        //handler to remove items from the cart (from cart view page)
        $('body').on('click', '.decrease-qty', (e)=>{
            let $productIdToRemove = $(e.currentTarget).parent().attr('id');
            productsData.removeItemFromCart($productIdToRemove);
            productsData.renderCartView();
            e.preventDefault();
        });

    }
}

export default new GUIcontroller();
