// owl-carousel banner
$(document).ready(function(){
$('#banner .owl-carousel' ).owlCarousel({
responsiveClass: true,
nav:true,
loop:true,
dots:true,
inifinite:true,
autoplay:true,
speed:1000,
autoplaySpeed:2000,
items:1,
navText:[
    "<i class='fas fa-angle-left'></i>",
    "<i class='fas fa-angle-right'></i>"
],
navContainer:".owl-nav"
});
});
// owl-carousel detail-produk img-big
$(document).ready(function(){
    $('.img-big .owl-carousel' ).owlCarousel({
    responsiveClass: true,
    nav:true,
    loop:true,
    dots:true,
    inifinite:true,
    speed:1000,
    items:1,
    navText:[
    "<i class='fas fa-angle-left'></i>",
    "<i class='fas fa-angle-right'></i>"
    ],
    navContainer:".nav-big",
    });
    });

    //owl- carousel detail-produk img-small
    $(document).ready(function(){
        $('.img-small .owl-carousel').owlCarousel({
            responsiveClass:true,
            margin:5,
            responsive:{
                0:{
                    items:3,
                    loop:true,
                },
                600:{
                    items:3,
                    loop:true,
                },
                1000:{
                    items:3,
                    loop:true,
                },
            }
        });
    });
    
    // owl-carousel produk-slide
    $(document).ready(function(){
        $('.slide .owl-carousel').owlCarousel({
            responsiveClass:true,
            margin:5,
            responsive:{
                0:{
                    items:3,
                    nav:true,
                    loop:true,
                },
                600:{
                    items:4,
                    nav:true,
                    loop:true,
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:true,
                },
            },
                navText:[
                    "<i class='fas fa-angle-left'></i>",
                    "<i class='fas fa-angle-right'></i>"
                    ],
                    navContainer:".nav-slide",

        });
    });



// pagination
function getPageList(totalPage, page, maxLength){
    /* getPageList start*/ 
    function rage(start, end)
    {
        return Array.from(Array(end - start + 1),(_, i) => i + start);
    }
    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;

    if(totalPage <= maxLength){
        return rage(1, totalPage);
    }
    if(page <= maxLength - sideWidth - rightWidth){
        return rage(1, maxLength - sideWidth - 1)
        .concat(0, rage(totalPage - sideWidth + 1, totalPage));
    }

    if(page >= totalPage - sideWidth - 1 - rightWidth){
        return rage(1, sideWidth)
        .concat(0, rage(totalPage - sideWidth - 1 - rightWidth - leftWidth, totalPage));
    }
    return rage(1, sideWidth).concat(0, rage(page - leftWidth, page + rightWidth),0,
    
    rage(page - leftWidth, page + rightWidth),0,
    rage(totalPage - sideWidth + 1, totalPage));
}/*getPageList end */

$(function()
{/*$ function start */
var numberOfItems = $(".single .card-produk").length;
var limitPerPage = 6; //jumlah produk yang ada di halaman produk
var totalPage = Math.ceil(numberOfItems / limitPerPage);
var paginationSize = 5;//jumlah angka yang di pagination
var currentPage;

function showPage(whichPage)
{/*showPage start */
    if(whichPage < 1 || whichPage > totalPage) return false;
    currentPage = whichPage;

    $(".single .card-produk").hide()
    .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();

    $(".pagination li").slice(1, - 1). remove();
    getPageList(totalPage, currentPage, paginationSize)
    .forEach(item =>{
        $("<li>")
        .addClass("page-item")
        .addClass(item ? "halaman" : "dots")
        .toggleClass("active", item === currentPage)
        .append(
            $("<a>")
            .addClass("page-link")
            .attr ({href:"javascript:void(0)"})
            .text(item || "..."))
        .insertBefore(".next");
    });
    $(".prev").toggleClass("disabled", currentPage === 1);
    $(".next").toggleClass("disabled", currentPage === totalPage);
    return true;
}/*showPage end */

$(".pagination")
.append(
    $("<li>")
    .addClass("page-item")
    .addClass("prev")
    .append(
        $("<a>")
        .addClass("page-link")
        .attr({href:"javascript:void(0)"})
        .text("prev")),

        $("<li>")
        .addClass("page-item")
        .addClass("next")
        .append(
            $("<a>")
            .addClass("page-link")
            .attr({href:"javascript:void(0)"})
            .text("next")),
);
$(".single .card-produk").show();
showPage(1);
$(document).on("click", ".pagination li.halaman:not(.active)",
function(){
    return showPage(+$(this).text());
});
$(".next").on("click",function()
{
    return showPage(currentPage +1);
});
$(".prev").on("click",function()
{
    return showPage(currentPage -1);
});
});

// Login
const container = document.querySelector(".container"),
lihatPass = document.querySelectorAll(".lihat-pass"),
tutupPass = document.querySelectorAll(".password");

lihatPass.forEach(eyeIcon =>{
eyeIcon.addEventListener("click", ()=>{
    tutupPass.forEach(tutupPassword =>{
        if(tutupPassword.type === "password"){
            tutupPassword.type = "text";

            lihatPass.forEach(icon =>{
                icon.classList.replace("fa-eye-slash","fa-eye")
            });
            
        } else{
            tutupPassword.type = "password";
            
            lihatPass.forEach(icon =>{
                icon.classList.replace("fa-eye","fa-eye-slash")
            });
        }
    });
});
});

//  raja Ongkir
$(document).ready(function(){

    $.ajax({
        url:'data_provinsi.php',
        type: 'post',
        success: function(data_provinsi){
            $("select[name=provinsi]").html(data_provinsi);
        }
    });
    // Kota/Kabupaten
    $('select[name="provinsi"]').on ("change", function(){

       var id_provinsi =  $("option:selected",this).attr("id_provinsi");

       $.ajax({ 
        url:'data_distrik.php',
        type: 'post',
        data:'id_provinsi='+id_provinsi ,
        success: function(data_distrik){
            $("select[name=distrik]").html(data_distrik);
        }
       });
    });

    $.ajax({ 
        url:'data_ekspedisi.php',
        type: 'post',
        success: function(data_ekspedisi){
            $("select[name=ekspedisi]").html(data_ekspedisi);
        }
       });

  $("select[name=ekspedisi]").on ("change", function(){

       var nama_ekspedisi = $("select[name=ekspedisi]").val();
       var datadistrik = $("option:selected","select[name=distrik]").attr("id_distrik");
       var total_berat = $("input[name=total_berat]").val();

       $.ajax({ 
        url:'data_paket.php',
        type: 'post',
        data:'ekspedisi='+nama_ekspedisi+'&distrik='+datadistrik+'&berat='+total_berat ,
        success: function(data_paket){
            $("select[name=paket]").html(data_paket);
            $("input[name=nama_ekspedisi]").val(nama_ekspedisi);
        }
       });

    });
    
  $("select[name=distrik]").on ("change", function(){
    var prov = $("option:selected",this).attr("nama_provinsi");
    var dist = $("option:selected",this).attr("nama_distrik");
    var type = $("option:selected",this).attr("type_distrik");
    var pos = $("option:selected",this).attr("kode_pos");

    $("input[name=nama_provinsi]").val(prov);
    $("input[name=nama_distrik]").val(dist);
    $("input[name=type_distrik]").val(type);
    $("input[name=kode_pos]").val(pos);

  });


  $("select[name=paket]").on ("change", function(){
    var paket = $("option:selected",this).attr("paket");
    var ongkir = $("option:selected",this).attr("ongkir");
    var etd = $("option:selected",this).attr("etd");

    $("input[name=paket]").val(paket);
    $("input[name=ongkir]").val(ongkir);
    $("input[name=estimasi]").val(etd);
    

  });

});

// filter js
(function ($) {
  
    $('#price-range-submit').hide();
  
      $("#min_price,#max_price").on('change', function () {
  
        $('#price-range-submit').show();
  
        var min_price_range = parseInt($("#min_price").val());
  
        var max_price_range = parseInt($("#max_price").val());
  
        if (min_price_range > max_price_range) {
          $('#max_price').val(min_price_range);
        }
  
        $("#slider-range").slider({
          values: [min_price_range, max_price_range]
        });
        
      });
  
  
      $("#min_price,#max_price").on("paste keyup", function () {                                        
  
        $('#price-range-submit').show();
  
        var min_price_range = parseInt($("#min_price").val());
  
        var max_price_range = parseInt($("#max_price").val());
        
        if(min_price_range == max_price_range){
  
              max_price_range = min_price_range + 100;
              
              $("#min_price").val(min_price_range);		
              $("#max_price").val(max_price_range);
        }
  
        $("#slider-range").slider({
          values: [min_price_range, max_price_range]
        });
  
      });
  
  
    //   $(document).ready(function () {
    
    //     function filterProducts(){
    //         $("#searchResults").html("<p>loading...</p>");
    //       var min_price =$("#min_price").val();
    //       var max_price =$("#max_price").val();
    //       // alert(min_price + max_price);
    
    //       $.ajax({
    //           url:"filter_data.php",
    //           type:"POST",
    //           data:{min_price:min_price,max_price:max_price},
    //           success:function (data) {
    
    //               $("#searchResults").html(data);
    //           }
    //       });
    //     }
    //     $("#min_price, #max_price").on('keyup',function(){
    //         filterProducts();   
    //     });
    //       $("#slider-range").slider({
    //         range: true,
    //         orientation: "horizontal",
    //         min: 0,
    //         max: 1000000,
    //         values: [0, 1000000],
    //         step: 100,
    
    //         slide: function (event, ui) {
    //           if (ui.values[0] == ui.values[1]) {
    //               return false;
    //           }
              
    //           $("#min_price").val(ui.values[0]);
    //           $("#max_price").val(ui.values[1]);
    //             filterProducts();
    //         }
    //       });
    
    //       $("#min_price").val($("#slider-range").slider("values", 0));
    //       $("#max_price").val($("#slider-range").slider("values", 1));
    //     });
    //   $("#slider-range,#price-range-submit").click(function () {
  
    //     var min_price = $('#min_price').val();
    //     var max_price = $('#max_price').val();
  
    //     $("#searchResults").text("Here List of products will be shown which are cost between " + min_price  +" "+ "and" + " "+ max_price + ".");
    //   });
  
    
  })(jQuery);

