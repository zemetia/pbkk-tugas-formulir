<title> Formulir Yoel </title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
<!-- method="POST" action="/api/test" enctype="multipart/form-data" -->
<div
    class='bg-[url("https://www.its.ac.id/informatika/wp-content/uploads/sites/44/2018/03/IFl.jpg")] bg-no-repeat bg-cover' />
<div class='w-full h-full flex items-center justify-center bg-black/50'>
    <div class="w-auto min-w-1/3 px-5 py-8 bg-slate-100/90 rounded-lg ">
        <table>
            <thead>
                <tr>
                    <th>UUID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Height</th>
                    <th>Age</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingpo as $data)
                    <tr>
                        <td class='p-3'>{{ $data->id }}</td>
                        <td class='p-3'>{{ $data->name }}</td>
                        <td class='p-3'>{{ $data->email }}</td>
                        <td class='p-3'>{{ $data->height }}</td>
                        <td class='p-3'>{{ $data->age }}</td>
                        <td class='p-3'><img src='{{ url('storage/' . $data->file_location) }}'
                                class='rounded-full h-10'></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id='notification' class="fixed top-0 left-0 p-4 w-80 flex flex-col gap-3">
            <!-- Notification Modal -->
        </div>

        <div id='message'></div>

        <script type="text/javascript">
            var test;
            let ingpo = '{{ $ingpo }}';
            ingpo = JSON.parse(ingpo.replaceAll("&quot;", '"'));
            $("#formulir").submit(function(event) {
                event.preventDefault();
                var formData = new FormData($("#formulir")[0]);
                $.ajax({
                    type: "POST",
                    url: "/api/formulir",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        test = data;
                        if (data.hasOwnProperty('errors')) {
                            Object.entries(test.errors).map(([k, v]) => {
                                v.forEach(vd => {
                                    $("#notification").append($(`<div class="bg-red-400 p-4 shadow-md rounded-lg w-full">
                                    <h2 class="text-lg font-semibold text-white">Error: ${vd}</h2>
                                    </div>`));
                                })
                            });
                        } else {
                            $("#formulir")[0].reset();
                            $("#notification").append($(`<div class="bg-green-400 p-4 shadow-md rounded-lg w-full">
                            <h2 class="text-lg font-semibold text-white">Berhasil Submit</h2>
                            </div>`));
                        }
                        setTimeout(removeTopChild, 3000);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
                return false;
            });

            function removeTopChild() {
                const parent = $('#notification');
                const firstChild = parent.children().first();

                if (firstChild.length) {
                    firstChild.remove();
                    setTimeout(removeTopChild, 3000);
                }
            }

            setTimeout(removeTopChild, 3000);
        </script>
    </div>
</div>
