<template>

    <div class="create-modal">
        <!-- Button trigger modal -->
         <a class="btn badge badge-success badge-pill" data-toggle="modal"  :data-target="'#' + roles.client + metodo +key "  >#{{ roles.id }}</a>
      

        <!-- Modal -->
        <div class="modal fade" :id="roles.client + metodo+key" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style=" border-bottom-width: medium;">
                        <h2 class="modal-title" id="exampleModalLabel">{{ roles.id }}     </h2>
                         <h2 class="modal-title" id="exampleModalLabel">|{{ metodo }}</h2>
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
                                   
                                            <div class="row" v-if="item.pivot.extras != '[]'" > 
                                             <div class="col"></div>
                               <div class="col-2"><h3 > Extras:</h3> </div>
                               <div class="col" style="padding-top: 1rem;"  v-if="mostrar == false" ><button type="button" @click="extra(item.pivot.extras)" class="btn btn-primary">mostrar</button></div>
                                                <div class="col" style="padding-top: 1rem;" v-if="mostrar == true" >
                                                    <div v-for="it in extraList"   > 
                                                              * {{ it  }}
                                                      </div>
                                             
                                                </div>

                                             
                                                      
                                    </div> 

                       
                          
                      
                      </div> 
                       <div class="row" > 
                        <h2 > informacion del cliente:</h2></br>
                       
                      
                      </div> 
                       <div class="row" > 
                               <div class="col-2"><h3 > Nombre:</h3> </div>
                               <div class="col" style="padding-top: 1rem;"><p>{{ roles.client }}</p></div>
                                 <div class="col"></div>
                       </div> 

                       <div class="row" >
                              <div class="col-2"><h3 > Telefono:</h3> </div>
                               <div class="col"  style="padding-top: 1rem;"><p><i class="ni ni-mobile-button"></i> &nbsp  <a>{{ roles.phone }} </a> </p></div> 
                               <div class="col"></div>
                                </div> 
                       <div class="row" > 
                      
                      

                               <div class="col-2"><h3 >Direccion:</h3> </div>
                               <div class="col"  style="padding-top: 1rem;"><p>{{ roles.Address.address }}</p></div> 
                               <div class="col"></div>
                      
                      </div> 
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      
                           <a class="btn btn-primary" :href="roles.link"  >Mas Detalles</a>
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
                extraList: [''],
                 mostrar:false,
                metodo:'',
                key:'',
                 extraText:''
            }
        },
        mounted: function(){
            console.log(this.roles);
          this.key=Math.random().toString(36).substr(2, 5);
               if (this.roles.delivery_method == 1) {
        this.metodo="Recogida";
    }else{
        
         this.metodo='Entrega';
    }
    
        },
        methods: {
            save: function(){

                this.$emit('guardar', this.usuario);
            },
                mostrarModal(){
      this.mostrar = true;
    },

     
    cerrarModal(){
      this.mostrar = false;

    },

              extra(id){
                     var cadenaVerso = id;
                     var cadena =  cadenaVerso.slice(1, -1);
                 
                   var arrayDeCadenas = cadena.split(",");
                console.log( arrayDeCadenas );
                     
              var cadenaVersoarray = [];

                arrayDeCadenas.forEach(function(word) {
                                                  console.log(word);

                                                    var indes= word.indexOf("+");
                                                   var name =   word.slice(0, indes);
                                                      cadenaVersoarray.push(name);
                                        
                                                
                        });

                 console.log( cadenaVersoarray );
                  this.extraList=cadenaVersoarray;

                  this.mostrar = true;

                                    }
        }

    }
</script>
<style lang="css">
.overly-modal-add{
  width: 100%;
  position: fixed;
  bottom: 0;
  left: 0;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.87);
  z-index: 99999;
  overflow-y: scroll;
  display: none;
  transition: .5 all ease;

}
.overly-modal-add.mostrar{
  top:0px;
  transition: .5 all ease;
  display: block;
}


</style>

