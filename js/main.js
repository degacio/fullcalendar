
// Remove o cache do ajax para evitar erros de load
$.ajaxSetup({cache: false});


// Codigo para Load das páginas ativados pelos botões do menu lateral 
    $(document).ready(function(){
        
        //  Reload do calendario 
        $("#cal").click(function(){
            location.reload();
        });

        //  Load do demo usado para testes
        $("#demo").click(function(){
            $("#LoadContent").load("demo.html", function(responseTxt, statusTxt, xhr){
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
            });
        });       
    });




// Sidebar toggle Menu behavior
 $(function(){        
    $('#sidebarCollapse').on('click', function() {
         $('#sidebar, #content').toggleClass('active');
    });
});