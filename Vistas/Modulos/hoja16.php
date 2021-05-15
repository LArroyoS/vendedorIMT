<div style="background: #555555; min-height: 100vh">

    <div id="navbar">

        <div class="izquierda">

            <img src="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/img/hoja16/pdf_icono.png" width="80px" />

        </div>

        <div class="centro">

            <div>

                <input id="archivo" class="inputText" type="text" name='nomArchivo' placeholder="nombre del archivo"
                    value="Nuevo Archivo" />

            </div>

            <button class="button button5" id="nuevaPagina">Agregar pagina</button>
            <button class="button button5" id="imprimir">Imprimir</button>

            <div class="linea mg-sep-elementos">

                <label for="borde" class="bloque tx-aling-centro">Imprimir borde</label>
                <div class="bloque tx-aling-centro" style="border: 1px">

                    <label class="switch linea">

                        <input id="borde" type="checkbox" checked>
                        <span class="slider round"></span>

                    </label>

                </div>

            </div>

            <div class="linea mg-sep-elementos">

                <label for="orientacion" class="bloque tx-aling-centro">Orientación</label>
                <div class="bloque tx-aling-centro" style="border: 1px">

                    <select id="orientacion">

                        <option value="Vertical" selected>Vertical</option>
                        <option value="Horizontal">Horizontal</option>

                    </select>

                </div>

            </div>

            <div class="linea mg-sep-elementos">

                <label for="tipoArchivo" class="bloque tx-aling-centro">Archivo</label>
                <div class="bloque tx-aling-centro" style="border: 1px">

                    <select id="tipoArchivo">

                        <option value="Catalogo" selected>Catalogo</option>
                        <option value="Etiquetas">Etiquetas</option>

                    </select>

                </div>

            </div>

            <input type="file" id="imagen" accept="image/*" style="display: none;" />

        </div>

    </div>

    <div id="menu">

        <ul>

            <li id="1">Combinar Celdas</li>
            <li id="2">Separar Celda</li>
            <li id="3">Insertar Imagen</li>
            <li id="4">Quitar Imagen</li>
            <li id="5">Eliminar pagina</li>

        </ul>

    </div>

    <div id="documento" style="margin-bottom: 10px;">

        <div class="pagina">

            <table>

                <tbody>

                    <tr>

                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>

                    </tr>

                    <tr>

                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>

                    </tr>

                    <tr>

                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>

                    </tr>

                    <tr>

                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>