<div class="   h-[780px] ">
    <h1 class="p-6 mb-8 text-3xl font-bold">EMEF Dr. Carlos de Almeida</h1>
    <div class="flex items-center justify-center h-full">
        <div class="w-full p-4 px-8">
           <div class="flex items-center justify-center w-full gap-6">
            <hr class="w-40 border-gray-400">
            <h2 class="text-xl font-semibold ">Patrimonios</h2>
            <hr class="w-40 col-span-2 border-gray-400">
           </div>


           {{-- <div class="grid grid-cols-12 gap-20 px-20 mt-4">
                <div class="grid grid-cols-12 col-span-4 ">
                    <div class="col-span-12 bg-white border border-gray-200 rounded-md shadow-lg h-28">

                    </div>
                    <div class="col-span-4">

                    </div>
                    <div class="flex items-center justify-center h-10 col-span-4 gap-1 mt-3 text-xs text-gray-700 bg-white border border-gray-200 rounded-md shadow-lg cursor-pointer hover:bg-gray-100 ">
                        <p class="">30 dias</p>
                        <x-ts-icon icon="arrow-down" class="w-4 font-black"/>

                    </div>
                </div>


               <div class="col-span-4 bg-white border border-gray-200 rounded-md shadow-lg h-28">

               </div>
               <div class="col-span-4 bg-white border border-gray-200 rounded-md shadow-lg h-28">

               </div>
           </div> --}}

           <div class="flex items-center justify-between w-full gap-12 mt-8">
            <div class="flex flex-col items-center justify-center w-1/3 gap-3">
                <div class="flex flex-col items-center justify-center w-full h-32 bg-white shadow-md rounded-xl">
                    <h3 class="text-[60px] font-bold text-gray-800">120</h3>
                    <p class="text-xs font-semibold text-gray-500">Dentro da unidade</p>
                </div>
                <div class="w-[100px] h-8 bg-white flex shadow-md items-center justify-center gap-1 hover:font-semibold rounded-md hover:bg-gray-100 cursor-pointer focus:bg-gray-100 focus:font-semibold">
                    30 dias <x-ts-icon class="w-4 h-4 " icon="arrow-down"/>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center w-1/3 gap-3">
                <div class="flex flex-col items-center justify-center w-full h-32 bg-white shadow-md rounded-xl">
                    <h3 class="text-[60px] font-bold text-red-800">2</h3>
                    <p class="text-xs font-semibold text-red-500">Danificados</p>
                </div>
                <div class="w-[100px] h-8 bg-white flex shadow-md items-center justify-center gap-1 hover:font-semibold rounded-md hover:bg-gray-100 cursor-pointer focus:bg-gray-100 focus:font-semibold">
                    30 dias <x-ts-icon class="w-4 h-4 " icon="arrow-down"/>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center w-1/3 gap-3">
                <div class="flex flex-col items-center justify-center w-full h-32 bg-white shadow-md rounded-xl">
                    <h3 class="text-[60px] font-bold text-gray-600">30</h3>
                    <p class="text-xs font-semibold text-gray-500">Sem uso</p>
                </div>
                <div class="w-[100px] h-8 bg-white flex shadow-md items-center justify-center gap-1 hover:font-semibold rounded-md hover:bg-gray-100 cursor-pointer focus:bg-gray-100 focus:font-semibold">
                    30 dias <x-ts-icon class="w-4 h-4 " icon="arrow-down"/>
                </div>
            </div>
           </div>

           <div class="mt-8 ">
                <div class="w-full pt-2 pl-4 bg-white border-gray-100 shadow-md rounded-xl h-72">
                    <canvas id="graficoPrincipal" style="width: 100%;" height="288"></canvas>

                </div>
           </div>

           <div class="flex gap-20 mt-8">
                <div class="w-3/5 pt-2 pl-4 bg-white border-gray-100 shadow-md rounded-xl h-60">
                    <canvas id="graficoSecundario" style="width: 100%;" height="240"></canvas>

                </div>
                <div class="w-2/5 bg-white border-gray-100 shadow-md rounded-xl h-60">

                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (() => {
            const labelsPrincipal = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dec'];
            const dataPrincipal = {
                labels: labelsPrincipal,
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40, 70, 32, 42, 30, 56, 70, 32],
                    backgroundColor: [
                        'rgba(253, 192, 41, 1)',
                        'rgba(253, 237, 185, 1)',
                        'rgba(253, 192, 41, 1)',
                        'rgba(253, 237, 185, 1)',
                        'rgba(253, 192, 41, 1)',
                        'rgba(253, 237, 185, 1)',
                        'rgba(253, 192, 41, 1)',
                        'rgba(253, 237, 185, 1)',
                        'rgba(253, 192, 41, 1)',
                        'rgba(253, 237, 185, 1)',
                        'rgba(253, 192, 41, 1)',
                        'rgba(253, 237, 185, 1)',
                    ],
                    borderColor: [
                        'rgb(255, 205, 86)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 159, 64)',
                    ],
                    borderWidth: 8
                }]
            };

            const configPrincipal = {
                type: 'bar',
                data: dataPrincipal,
                options: {
                    scales: { y: { beginAtZero: true } }
                }
            };

            new Chart(document.getElementById('graficoPrincipal'), configPrincipal);
        })();
        </script>

<script>
    (() => {
        const labelsSecundario = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];

        const dataSecundario = {
            labels: labelsSecundario,
            datasets: [
                {
                    label: 'Dataset 1',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    borderColor: 'rgba(253, 237, 20)',
                    tension: 0.1
                },
                {
                    label: 'Dataset 2',
                    data: [28, 48, 40, 19, 86, 27, 90],
                    fill: false,
                    borderColor: 'rgba(39, 51, 51, 1)',
                    tension: 0.1
                },
                {
                    label: 'Dataset 3',
                    data: [12, 25, 60, 32, 45, 70, 50],
                    fill: false,
                    borderColor: 'rgb(253, 237, 150)',
                    tension: 0.1
                }
            ]
        };

        const configSecundario = {
            type: 'line',
            data: dataSecundario,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                },
                scales: { y: { beginAtZero: true } }
            }
        };

        new Chart(document.getElementById('graficoSecundario'), configSecundario);
    })();
    </script>



</div>
