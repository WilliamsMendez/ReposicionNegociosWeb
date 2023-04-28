<h1>{{modedsc}}</h1>
<section class="row">
  <form action="index.php?page=Mnt_Car&mode={{mode}}&registro_id={{registro_id}}"method="POST"class="col-6 col-3-offset">
    <section class="row">
    <label for="registro_id" class="col-4">Código de registro_id</label>
    <input type="hidden" id="registro_id" name="registro_id" value="{{registro_id}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
    <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
    <input type="text" readonly name="registro_iddummy" value="{{registro_id}}"/>
    </section>
    <section class="row">
      <label for="placa_carro" class="col-4">placa_carro</label>
      <input type="text" {{readonly}} name="placa_carro" value="{{placa_carro}}" maxlength="45" placeholder="Placa ded Car"/>
      {{if placa_carro_error}}
        <span class="error col-12">{{placa_carro_error}}</span>
      {{endif placa_carro_error}}
    </section>

    <section class="row">
      <label for="modelo_carro" class="col-4">Modelo del Carro</label>
      <input type="text" {{readonly}} name="modelo_carro" value="{{modelo_carro}}" maxlength="45" placeholder="Modelo del Carro"/>
    </section>
    <section class="row">
      <label for="year_carro" class="col-4">Año del Car</label>
      <input type="text" {{readonly}} name="year_carro" value="{{year_carro}}" maxlength="45" placeholder="Año del Car"/>
    </section>
    <section class="row">
      <label for="bin_carro" class="col-4">Serie del Motor</label>
      <input type="text" {{readonly}} name="bin_carro" value="{{bin_carro}}" maxlength="45" placeholder="Serie del Motor"/>
    </section>
    
    {{if has_errors}}
        <section>
          <ul>
            {{foreach general_errors}}
                <li>{{this}}</li>
            {{endfor general_errors}}
          </ul>
        </section>
    {{endif has_errors}}
    <section>
      {{if show_action}}
      <button type="submit" name="btnGuardar" value="G">Guardar</button>
      {{endif show_action}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </section>
  </form>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=Mnt_Car");
      });
  });
</script>