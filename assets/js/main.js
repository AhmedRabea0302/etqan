/*global $*/



$(document).ready(function () {
    "use strict";
	$('.btn-responsive-nav').on('click', function () {
        $(this).parents('.wrapper').toggleClass('sidebar-collapse');
    });
});

/*File Upload 
=========================*/
$(document).ready(function () {
    "use strict";
    $("#file1").on("change", function () {
        document.getElementById("progressBar").style.width = 0 + '%';
        document.getElementById("progressBar").innerHTML = 0 + '%';
        $('.total-upload').html('');
        $("#status").html('');
        $(this).next("p").text($(this).val());
    });
});

/* Toggle dropdown-menu
========================*/
$(document).ready(function () {
    "use strict";
    $(".treeview > a").on("click", function (e) {
        e.preventDefault();
        $(this).toggleClass('open').next('.treeview-menu').slideToggle();    
    });
});

/* Upload Progress Bar Script
 Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg 
===============================*/
$(document).ready(function () {
    "use strict";
	function get_elment(el) {
        return document.getElementById(el);
    }

    // VIDEO
    function progressHandler(event) {
        get_elment("loaded_n_total").innerHTML = "<span class='total-upload'>Uploaded  "  + event.loaded + " bytes of " + event.total+"</span>";
        var percent = (event.loaded / event.total) * 100;
        var rounPercent = get_elment("progressBar").value = Math.round(percent);
        get_elment("progressBar").style.width = rounPercent + '%';
        get_elment("progressBar").innerHTML = rounPercent + '%';
        get_elment("status").innerHTML = Math.round(percent) + "% uploaded...";
    }
    function completeHandler(event) {
        get_elment("status").innerHTML = event.target.responseText;
        get_elment("progressBar").value = 0;
        $("#upload-btn").removeAttr("disabled");
    }
    function errorHandler(event) {
        get_elment("status").innerHTML = "Upload Failed";
        $("#upload-btn").removeAttr("disabled");
    }
    function abortHandler(event) {
        get_elment("status").innerHTML = "Upload Aborted";
    }
    function uploadFile() {
        
        var file = get_elment("file1").files[0],
            formdata = new FormData(),
            ajax = new XMLHttpRequest();
        formdata.append("file1", file);
	    
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "assets/js/file_upload_parser.php");
        ajax.send(formdata);
    }


    // BOOK 

    function progressHandlerBook(event) {
        get_elment("loaded_n_total2").innerHTML = "<span class='total-upload'>Uploaded  "  + event.loaded + " bytes of " + event.total+"</span>";
        var percent = (event.loaded / event.total) * 100;
        var rounPercent = get_elment("progressBar2").value = Math.round(percent);
        console.log('ROUNDED PERCENT: ', rounPercent);
        get_elment("progressBar2").style.width = rounPercent + '%';
        get_elment("progressBar2").innerHTML = rounPercent + '%';
        get_elment("status2").innerHTML = Math.round(percent) + "% uploaded...";
    }
    function completeHandlerBook(event) {
        get_elment("status2").innerHTML = event.target.responseText;
        get_elment("progressBar2").value = 0;
        $("#upload-book").removeAttr("disabled");
    }
    function errorHandlerBook(event) {
        get_elment("status2").innerHTML = "Upload Failed";
        $("#upload-book").removeAttr("disabled");
    }
    function abortHandlerBook(event) {
        get_elment("status2").innerHTML = "Upload Aborted";
    }
    

    function uploadBook() {
        
        var file = get_elment("file2").files[0],
            formdata = new FormData(),
            ajax = new XMLHttpRequest();
        formdata.append("file2", file);
	    
        ajax.upload.addEventListener("progress", progressHandlerBook, false);
        ajax.addEventListener("load", completeHandlerBook, false);
        ajax.addEventListener("error", errorHandlerBook, false);
        ajax.addEventListener("abort", abortHandlerBook, false);
        ajax.open("POST", "assets/js/file_upload_parser2.php");
        ajax.send(formdata);
    }

    $('#upload-btn').on('click', function () {
        uploadFile();
        $(this).attr("disabled", true);
    });
    
    $('#upload-book').on('click', function () {
        // alert("YEHAAAA");
        uploadBook();
        $(this).attr("disabled", true);
    });
});




/* Date range picker and SummerNote Eitor Trigger Code
=======================================================*/
$(document).ready(function () {
    "use strict";
    $('.daterange').daterangepicker();
    
    
    $('.summernote').summernote({height: 150});
        //API:
        //var sHTML = $('.summernote').code(); // get code
        //$('.summernote').destroy(); // destroy
    
});

/* Get Suspicions Childs List
=======================================================*/

$(document).ready(function() {
    $('li').one('click', function() {
        console.log('HERE FROM AJAX');
        var suspId = this.id;
        // alert("SUSP ID IS: ", this.id);
        console.log('LOG');
        var parentEle = this;
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/itqan_test/child-suspicions/"+suspId,
            success : function(results) {
                 alert("SUSP ID IS: ", this.id);
                console.log("Results: ", results);
                if(results == []) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "/itqan_test/suspicion-reply/"+suspId,
                        success : function(results) {
                            console.log('REPLY: ,', results);
                            ul.append("<li id='+ results[id] +'>" + results[i].suspicion +'</li>');
                        },

                        error: function(error) {
                            console.log('error: ', error);
                        }
                    });
                };
                var ul = $('<ul></ul>');
                for(i=0; i< results.length; i++) {
                    ul.append("<li id='+ results[id] +'>" + results[i].suspicion +'</li>');
                    console.log('LOG');
                }

                $(parentEle).append(ul);
                
            },
            error: function(errors) {
                console.log("Errors: ", errors);
            }
        });
    });
});

// $( document ).ready(function() {
//     $('.suspicions-list li').one('click', function() {
//         console.log("ID: ",this.id);
//         id = this.id;
//         parentEle = this;
//          $.ajax({
//              type: "GET",
//              dataType: "json",
//              url: "/itqan/child-suspicions/"+id,
//             //  beforeSend: function() {
//             //        $('.testdropdown').html('loading please wait...');
//             //  },
//              success : function(results) {
//                 console.log("Results: ", results);

//                 var ul = $('<ul></ul>');
//                 for(i=0; i< results.length; i++) {
//                     ul.append('<li><a href="#">' + results[i].suspicion +'</a></li>');
//                 }

//                 $(parentEle).append(ul);
                
//             },
//             error: function(errors) {
//                 console.log("Errors: ", errors);
//             }
//          });
//      });
// });


// $( document ).ready(function() {
//     $('.treeview').one('click', function() {
//         console.log("ID: ",this.id);
//         id = this.id;

//         element = this;
//             $.ajax({
//                 type: "GET",
//                 dataType: "json",
//                 url: "/itqan/child-suspicions/"+id,
//             //  beforeSend: function() {
//             //        $('.testdropdown').html('loading please wait...');
//             //  },
//                 success : function(results) {
//                     console.log("Results: ", results);
//                     var ul = $('<ul class="treeview-menu"></ul>');
//                     if(results) {
//                         for(i=0; i< results.length; i++) {
//                             ul.append('<li class="treeview" id="${`results[i].suspicion.id`}"><a href="#"><span>' + results[i].suspicion +'</span></a></li>');
//                         }

//                         $(element).append(ul);
//                     } else {
                        
//                     }
                    
//                 },
//                 error: function(errors) {
//                     console.log("Errors: ", errors);
//                 }
//             });
//         });
// });

