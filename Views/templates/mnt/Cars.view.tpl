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
                
            </tr>
            {{endfor cars}}
        </tbody>
    </table>
</section>
