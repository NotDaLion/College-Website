console.log("testing script connection");
 $(document).ready(function(){
    let price  = $(".cls-price");
    let desc = $(".cls-desc");
    let img = $(".cls-img");
    let cat = $(".cls-cat");
    let create = $("#op-create");
    let update = $("#op-update");
    let dlt = $("#op-delete");

    let optional = [price,desc,img,cat];

    create.click(function(){
        for(i = 0;i < 4;i++){
            optional[i].show();
            optional[i].attr("required",true);
        }
    })
    update.click(function(){
        for(i = 0;i < 4;i++){
            optional[i].show();
            optional[i].attr("required",true);
        }
    })
    dlt.click(function(){
        for(i = 0;i < 4;i++){
            optional[i].attr("required",true);
            optional[i].show();
        }
    })

}); 