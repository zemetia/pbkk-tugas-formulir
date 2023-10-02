<title> Formulir Yoel </title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
<!-- method="POST" action="/api/test" enctype="multipart/form-data" -->
<div
    class='bg-[url("https://www.its.ac.id/informatika/wp-content/uploads/sites/44/2018/03/IFl.jpg")] bg-no-repeat bg-cover' />
<div class='w-full h-full flex items-center justify-center bg-black/50'>
    <div class="w-1/3 px-5 py-8 bg-slate-100/90 rounded-lg ">
        <form class="flex flex-col gap-3" id='formulir' enctype="multipart/form-data">
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="name" id="floating_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="email" name="email" id="floating_email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                        address</label>
                </div>
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <input min="2.5" max="99.9" type="number" name="height" id="floating_height"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="floating_height"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Height
                    ( float )</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input min="12" type="number" name="age" id="floating_age"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="floating_age"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Age</label>
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    name="foto" id="file_input" type="file">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG (MAX.
                    2MB).</p>
            </div>

            <button type="submit" id="submit-btn"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
        <div id='notification' class="fixed top-0 left-0 p-4 w-80 flex flex-col gap-3">
            <!-- Notification Modal -->
        </div>

        <div id='message'></div>

        <script type="text/javascript">
            var test;
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
