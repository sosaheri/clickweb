<template>

    <div class="create-modal">
        <!-- Button trigger modal -->
         <a class="btn badge badge-success badge-pill" data-toggle="modal" data-target="#exampleModal"  >#{{ roles.id }}</a>
      

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Orden : {{ roles.id }}     </h2>
                         <h2 class="modal-title" id="exampleModalLabel">&nbsp &nbsp | {{ metodo }}</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"><div class="col"></div><div class="row"  ></div> 
                        
                         <div class="row"  >
                              <h2 >Productos:   </h2>
                         </div> 
                     <div v-for="item in roles.item" :key="item.id"  > 
                                   <div class="row"  >
                                  
                                    <div class="col"><span> <h3 >{{ item.pivot.qty  }}&nbsp X &nbsp   {{ item.name }}</h3></span></div>
                                  
                                   </div> 
                             
                                        
                       
                          
                      
                      </div> 
                       <div class="row" > 
                        <h2 > informacion del cliente:</h2></br>
                       
                      
                      </div> 
                       <div class="row" > 
                               <div class="col"><h3 > Nombre:</h3> </div>
                               <div class="col"><p>{{ roles.client }}</p></div>
                       </div> 
                       <div class="row" >
                              <div class="col"><h3 > Telefono:</h3> </div>
                               <div class="col"><p><i class="ni ni-mobile-button"></i> &nbsp  <a>{{ roles.phone }} </a> </p></div> 

                                </div> 
                       <div class="row" > 
                      
                            <div class="col">  <h3 >Direccion:</h3></div>
                               <div class="col"><p>{{ roles.Address.address }}</p></div> 
                      
                      </div> 
                        
                  ----------------------          
                          
------------------------------------------
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default{
        props: ['roles'],
        data: function(){

            return {
                usuario: {
                    name: '', email: '', password: '',
                    nombre: '', apellido: '', cedula: '',
                    celular: '', codigo_alumno: '',
                    codigo_representante: '',type_cuenta: '',
                    role: ''
                },
                rolesList: [],
                metodo:''
            }
        },
        mounted: function(){
            console.log(this.roles);
               if (this.roles.delivery_method == 1) {
        this.metodo="Recogida";
    }else{
        
         this.metodo='Entrega';
    }
    
        },
        methods: {
            save: function(){

                this.$emit('guardar', this.usuario);
            }
        }

    }
</script>

