$(document).ready(function(){

     //Desabilitar el botón de generarDocumento
     $('#generardocumento').attr('disabled','disabled');

    $('#finalizarOrden').click(function(){
       
        //alert($('#area_trabajo').val());
        var areaTrabajo="";

        if($('#area_trabajo').val()=='otros'){
     
            areaTrabajo=$('#otra').val();
        }else{
           areaTrabajo=$('#area_trabajo').val();
        }
        
        
      if($('#select_servicio').val()==1){
            if($('#contacto').val()!="" && $('#select_servicio').val()!="",$('#select_unidad').val()!="" && $('#fecha_inicial').val()!=""&&
            $('#fecha_final').val()!="" && $('#direcol').val()!=""
             && $('#direntrega').val()!="" && $('#cddes').val()!="" && $('#timeR').val()!="" && $('#timeC').val()!=""
            && $('#costo').val()!=""){
                $('input').attr('disabled','disabled');
                //$('select').attr('disabled','disabled');
                //$('#finalizarOrden').attr('disabled','disabled');
                $('#generardocumento').removeAttr('disabled','disabled');
                $contacto = $('#contacto').val();
                $timeIni='00:00:00';
                $timeFin='00:00:00';
                $km='0';
                $monto_deposito='0';
                $valor_pagare='0';
                $.ajax({
                    type:"POST",
                    url:"../controller/add_servicio.php",
                    data: "idc=" + $('#idc').val() + "&ids=" + $('#ids').val() + "&contacto="+ $('#contacto').val() +
                    "&select_servicio=" + $('#select_servicio').val() + "&select_unidad=" + $('#select_unidad').val() +
                    "&fecha_inicial=" + $('#fecha_inicial').val() + "&fecha_final=" + $('#fecha_final').val() +
                    "&timeI=" + $timeIni + "&timeF=" + $timeFin +
                    "&area_trabajo=" + areaTrabajo + "&kilometraje=" +  $('#kilometraje').val() +"&monto_deposito=" + $monto_deposito + 
                    "&valor_pagare=" + $valor_pagare +
                    "&direcol=" + $('#direcol').val()+ "&direntrega=" + $('#direntrega').val()+ "&cddes=" + $('#cddes').val()+
                    "&timeR=" + $('#timeR').val()+ "&timeC=" + $('#timeC').val()+"&costo=" + $('#costo').val(),
                    success:function(response){
                        alert(response);

                        if(response==="La unidad esta Ocupado"){
                            
                            window.location("servicios.php"); 
                            $('#generardocumento').removeAttr('disabled','disabled');
                        }
                      
                    },
                    
                });

            }else {
                alert("Por favor, rellene todos campos.");
         
            }

        }else{
            if($('#contacto').val()!="" && $('#select_servicio').val()!="",$('#select_unidad').val()!="" && $('#fecha_inicial').val()!=""&&
            $('#fecha_final').val()!="" && $('#area_trabajo').val()!="" && $('#timeI').val()!=""
            && $('#timeF').val()!=""){
                $('input').attr('disabled','disabled');
                //$('select').attr('disabled','disabled');
                //$('#finalizarOrden').attr('disabled','disabled');
                $('#generardocumento').removeAttr('disabled','disabled');
                $.ajax({
                    type:"POST",
                    url:"../controller/add_servicio.php",
                    data: "idc=" + $('#idc').val() + "&ids=" + $('#ids').val() + "&contacto="+ $('#contacto').val() +
                    "&select_servicio=" + $('#select_servicio').val() + "&select_unidad=" + $('#select_unidad').val() +
                    "&fecha_inicial=" + $('#fecha_inicial').val() + "&fecha_final=" + $('#fecha_final').val() +
                    "&timeI=" + $('#timeI').val() + "&timeF=" + $('#timeF').val() +
                    "&area_trabajo=" + areaTrabajo + "&kilometraje=" + $('#kilometraje').val()+ "&monto_deposito=" + $('#monto_deposito').val()+
                    "&valor_pagare=" + $('#valor_pagare').val()+
                    "&direcol=" + $('#direcol').val()+ "&direntrega=" + $('#direntrega').val()+ "&cddes=" + $('#cddes').val()+
                    "&timeR=" + $('#timeR').val()+ "&timeC=" + $('#timeC').val()+"&costo=" + $('#costo').val(),
                    success:function(response){
                        alert(response);
                        
                        if(response==="La unidad esta Ocupado"){
                           
                           window.location("servicios.php"); 
                           $('#generardocumento').removeAttr('disabled','disabled');
                        }
                      
                    },
                    
                });

            }else {
                alert("Por favor, rellene todos campos.");
            }

        }

        

      
    });

    //Generar formulario
    $('#generardocumento').click(function(){
        var serv = document.getElementById("select_servicio").value;
        var cli = document.getElementById("contacto").value;
        var uni = document.getElementById("select_unidad").value;
        var fi = document.getElementById("fecha_inicial").value;
        if(serv==1){
          
            window.open('../controller/ordenServicio.php?idc='+cli+'&idu='+uni+'&fi='+fi,'_blank'); 
        }
        if(serv==2){

            window.open('../controller/contratoServicio.php?idc='+cli+'&idu='+uni+'&fi='+fi,'_blank'); 

        }
      
        
        
    });

     //Generar excel
     $('#generarReporte').click(function(){
       /* var serv = document.getElementById("myInputcli").value;
       alert (serv);*/
       $.ajax({
        type:"POST",
        url:"../controller/generarExcel.php",
        data: "tip=cliente&idc=" + document.getElementById("myInputcli").value,
        success:function(response){
           alert(response);
        },
        
    });
        
    });

    $('#generarMantenimineto').click(function(){
        var tipomant= $('input[name=mantenimiento]:checked').val();

        if(tipomant==="Mantenimiento No programado"){
            var selecNoProgra = $('#manNoProgramado').val();

            if(selecNoProgra=='otro1'){
                var tipomante= $('#otromante1').val();
            }else{
                var tipomante=$('#manNoProgramado').val();
            }

            var data_to_send = "oper=mantenimientouni"+"&mantenimineto=" + $('#programado').val() + "&mantProgramado=" + tipomante + 
            "&descripcion="+ $('#descripcion').val() +
            "&Inifecha=" + $('#Inifecha').val() + "&Finfecha=" + $('#Finfecha').val()+
            "&idun=" + $('#idun').val()+"&costomante=" + $('#costomante').val()+ "&idserv=" + $('#idserv').val()+ 
            "&idscur=" + $('#idscur').val()+"&disponibilidad=" + $('#select_disponibilidad').val();

            $.ajax({
                type:"POST",
                url:"../controller/add_mantenimiento.php",
                data: data_to_send,
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    if(response.mensaje=="La unidad esta Ocupado"){
                     window.location.replace("unidades_servicio_editar.php?idu="+response.idu);
                    }else{
                        alert(response.mensaje);
                        window.location.href = '../views/unidades.php';
                    }
                },
                error: function(error){
                    alert("Ocurrio un error, contacte con soporte");
                    console.log(error)
                }
            });
       }else{
            var selecProgra = $('#mantProgramado').val();
        
            if(selecProgra=='otro2'){
                var tipomante1= $('#otromante2').val();
            }else{
                var tipomante1=$('#otromante2').val();
            }
            var data_to_send = "oper=mantenimientouni"+"&mantenimineto=" + $('#programado').val() + "&mantProgramado=" + tipomante1 + 
            "&descripcion="+ $('#descripcion').val() +
            "&Inifecha=" + $('#Inifecha').val() + "&Finfecha=" + $('#Finfecha').val()+
            "&idun=" + $('#idun').val()+"&costomante=" + $('#costomante').val()+ "&idserv=" + $('#idserv').val()+ 
            "&idscur=" + $('#idscur').val()+"&disponibilidad=" + $('#select_disponibilidad').val();

            $.ajax({
                type:"POST",
                url:"../controller/add_mantenimiento.php",
                data: data_to_send,
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    if(response.mensaje=="La unidad esta Ocupado"){
                     window.location.replace("unidades_servicio_editar.php?idu="+response.idu);
                    }else{
                        alert(response.mensaje);
                        window.location.href = '../views/unidades.php';
                    }
                },
                error: function(error){
                    alert("Ocurrio un error, contacte con soporte");
                    console.log(error)
                }
            });
        }
    });
   
    //Generar formulario
    $('#editarUnidad').click(function(){
        var caja = $('input[name=caja]:checked').val();
        var refrigeracion = $('input[name=refrigeracion]:checked').val();
        

       $.ajax({
            type:"POST",
            url:"../controller/add_unidad.php",
            data: "edit_unidad=edit_unidad"+"&iduni=" + $('#iduni').val() + "&iddis=" + $('#iddis').val() + 
            "&tip="+ $('#tip').val() +"&ids=" + $('#ids').val() + "&fecha=" + $('#fecha').val()+
            "&marca=" + $('#marca').val()+"&modelo=" + $('#modelo').val()+
            "&numserie=" + $('#numserie').val()+"&placas=" + $('#placas').val()+
            "&caja=" + caja + "&refrigeracion=" + refrigeracion +
            "&capasidad=" + $('#capasidad').val()+"&costo=" + $('#costo').val()+
            "&nombre=" + $('#nombre').val()+"&comentario=" + $('#comentario').val()
            +"&foto=" + $('#foto').val(),
            success:function(response){
               alert(response);
            },
            
        });
        
    });

    $('.edit_uni').click(function(e){
        e.preventDefault();
        var unid =$(this).attr('unidad');
        var mensaje = confirm("El servicio de la Unidad ha finalizado, Desea cambias la Disponibilidad de la unidad?");
        if (mensaje) {
            $.ajax({
                type:"POST",
                url:"../controller/alterarDispo.php",
                data: "edit_dispo=edit_unidad"+"&iduni=" + unid,
                success:function(response){
                   alert(response);
                   window.location.href = '../views/unidades.php';
                },
                
            });

            //alert("¡La Disponibildad de la Unidad paso a ser DISPONIBLE!");
            }
            
            else {
            alert("¡La Disponibilidad de la Unidad es NO DISPOBIBLE!");
            }
        
        
    });

    $('.edit_uni1').click(function(e){
        e.preventDefault();
        var unid =$(this).attr('unidad');
        var fechaActi =$(this).attr('fechaActividad');
     
       var mensaje = confirm("¿Desea Cambiar la DISPONIBILIDAD DE LA UNIDAD?");
        if (mensaje) {
            $.ajax({
                type:"POST",
                url:"../controller/alterarDispo.php",
                data: "edit_dispo=edit_unidad"+"&iduni="+unid+"&fechaActivi="+fechaActi,
                success:function(response){
                   alert(response);
                   window.location.href = '../views/unidades.php';
                },
                
            });

            //alert("¡La Disponibildad de la Unidad paso a ser DISPONIBLE!");
            }
            
            else {
            alert("¡La Disponibilidad de la Unidad es NO DISPOBIBLE!");
            }
        
        
    });


    $('.baja_unidad').click(function(e){
        e.preventDefault();
        var unid =$(this).attr('baja');
        var mensaje = confirm("¡Esta apunto de dar de Baja la Unidad! ¿DESEA CONTINUAR?");
        var descripcion = prompt("¿Describa los motivos?", "");
        var dinero = prompt("¿Ingresa la Cantidad ($$):?", "");//.innerHTML(id, "a");
        /*$("#a").on({
            "focus": function (event) {
                $(event.target).select();
            },
            "keyup": function (event) {
                $(event.target).val(function (index, value ) {
                    return value.replace(/\D/g, "")
                                .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
            }
          });*/
        if (mensaje) {
            $.ajax({
                type:"POST",
                url:"../controller/baja_unidad.php",
                data: "baja_dispo=baja_unidad"+"&iduni=" + unid+"&descrip=" + descripcion+"&precio=" + dinero,
                success:function(response){
                   alert(response);
                   window.location.href = '../views/unidades.php';
                },
                
            });

            alert("¡La Disponibildad de la Unidad paso a ser DISPONIBLE!");
            }
            
            else {
            alert("¡No se dio de baja la Unidad!");
            }
        
        
    });

    $('#addclientes').click(function(){
        var tipomant= $('input[name=pago2]:checked').val();
        
        if(tipomant=="fisica"){
            if($('#contacto').val()!="" && $('#correocont').val()!=""&& $('#nomcli').val()!="" && $('#telcli').val()!=""&&
            $('#celular').val()!="" && $('#ine').val()!="" && $('#correocli').val()!="" && $('#dircli').val()!="" && $('#rfc1').val()!=""){

               
                $.ajax({
                    type:"POST",
                    url:"../controller/add_cliente.php",
                    data: "add_clientes=add_clientes"+"&contacto=" + $('#contacto').val() + "&correocont=" + $('#correocont').val() + 
                    "&nomcli="+ $('#nomcli').val() +"&telcli=" + $('#telcli').val() + "&celular=" + $('#celular').val()+
                    "&ine=" + $('#ine').val()+"&correocli=" + $('#correocli').val()+
                    "&dircli=" + $('#dircli').val()+"&persona=" + tipomant +"&idsuccli=" + $('#idsuccli').val()+"&rfc1=" + $('#rfc1').val(),
                    success:function(response){
                       alert(response);
                       window.location.href = '../views/clientes.php';
                    },
                    
                });

            }else{
                alert("Por favor, rellene todos campos");
            }
            

        }
        if(tipomant=="moral"){
            if($('#contacto').val()!="" && $('#correocont').val()!="" && $('#razonsocial').val()!="" && $('#cp').val()!=""&&
            $('#colonia').val()!="" && $('#ciudad').val()!="" && $('#estado').val()!="" && $('#dirsocial').val()!="" 
            && $('#rfc').val()!="" && $('#correofac').val()!=""){
                
                $.ajax({
                    type:"POST",
                    url:"../controller/add_cliente.php",
                    data: "add_clientes=add_clientes"+"&contacto=" + $('#contacto').val() + "&correocont=" + $('#correocont').val() + 
                    "&razonsocial="+ $('#razonsocial').val() +"&cp=" + $('#cp').val() + "&colonia=" + $('#colonia').val()+
                    "&ciudad=" + $('#ciudad').val()+"&estado=" + $('#estado').val()+
                    "&dirsocial=" + $('#dirsocial').val()+"&rfc=" + $('#rfc').val()
                    +"&correofac=" + $('#correofac').val()+"&persona=" + tipomant +"&idsuccli=" + $('#idsuccli').val(),
                    success:function(response){
                       alert(response);
                       window.location.href = '../views/clientes.php';
                    },
                    
                });

            }else{
                alert("Por favor, rellene todos campos");
            }
            

        }
        

    });

 
    
});