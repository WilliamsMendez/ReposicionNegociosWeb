<h1>Gestion de Registros de Carros</h1>
<section class="WWFilter"></section>

<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id Registro</th>
                <th>Placa de carro</th>
                <th>Modelo de carro</th>
                <th>Año de carro</th>
                <th>Bin de motor</th>

                <th>
                    {{if new_enable}}
                    <button id="btnAdd">Nuevo</button>
                    {{endif new_enable}}
                </th>
            </tr>
        </thead>
        <tbody>
            {{forecha cars}}
            <tr>
                <td>{{registro_id}}</td>
                <td><a href="index.php?page=Mnt_Car&mode=DSP&registro_id={{registro_id}}">{{placa_carro}}</a></td>
                <td>{{modelo_carro}}</td>
                <td>{{year_carro}}</td>
                <td>{{bin_carro}}</td>
                <td>
                    {{if ~edit_enabled}}
                    <form action="index.php" method="get">
                        <input type="hidden" name="page" value="Mnt_Car"/>
                        <input type="hidden" name="mode" value="UPD" />
                        <input type="hidden" name="registro_id" value={{registro_id}} />
                        <button type="submit">Editar</button>
                    </form>
                    {{endif ~edit_enabled}}
                    {{if ~delete_enabled}}
                    <form action="index.php" method="get">
                        <input type="hidden" name="page" value="Mnt_Car"/>
                        <input type="hidden" name="mode" value="DEL" />
                        <input type="hidden" name="registro_id" value={{registro_id}} />
                        <button type="submit">Eliminar</button>
                    </form>
                    {{endif ~delete_enabled}}
                </td>
            </tr>
            {{endfor cars}}
        </tbody>
    </table>
</section>

<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_car&mode=INS&registro_id=0");
      });
    });
</script>