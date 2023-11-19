<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background Remover</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <h1 id="h1">Background Image Remover</h1>
    <h2 id="h2">No need to worry about a bad Background. With this technology you can easily remove any background from
        any image.</h2>
    <div class="container mt-4">
        <div id="ii""row mt-4">
            <div id="i" class="col-md-12 card mt-4">
                <form>
                    <div class="form-group">
                        <label id="idd" for="fileInput">Select a File: </label>
                        <input id="fileInput" class="form-control" type="file">
                    </div>
                    <input id="red" class="btn btn-primary m-1" type="button" onclick="submitHandler()" value="Upload">
                </form>

                <button id="b" class="btn btn-warning" onclick="downloadFile()">
                    Download
                </button>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <style>
        #idd {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 700;
            color: #990011;
        }

        #i {
            background-color: #FCF6F5;
        }

        #ii {
            background-color: #FCF6F5;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #FCF6F5;
            margin: 0;
            padding: 0;
            text-align: center;

        }

        #h1 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            color: #990011;
            background-color: #FCF6F5;

        }

        #b {
            border-radius: 50px;
            padding: 20px 50px;
            border: none;
            font-size: 16px;


            background-color: #990011;
            color: #FCF6F5;

            font-family: sans-serif;
            cursor: pointer;

        }



        #h2 {
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 0;
            background-color: #FCF6F5;
            color: #990011;
        }

        #red {
            border-radius: 50px;
            padding: 20px 50px;
            border: none;
            font-size: 16px;
            background-color: #990011;
            color: #FCF6F5;

            font-family: sans-serif;
            cursor: pointer;
            animation: animate 2s linear infinite;
        }

        #b:hover {
            background-color: black;
        }

        #red:hover {
            background-color: black;
        }
    </style>
    <script>
        let imageURL;

        function submitHandler() {
            console.log("click");
            const fileInput = document.getElementById('fileInput');
            console.log(fileInput.files);
            const image = fileInput.files[0];

            // Multipart file
            const formData = new FormData();
            formData.append('image_file', image);
            formData.append('size', 'auto');

            const apiKey = 'UkH2ptVszpceBpb3Kmq4ewwg';

            fetch('https://api.remove.bg/v1.0/removebg', {
                method: 'POST',
                headers: {
                    'X-Api-Key': apiKey
                },
                body: formData
            })
                .then(function (reponse) {
                    return reponse.blob()
                })
                .then(function (blob) {
                    console.log(blob);
                    const url = URL.createObjectURL(blob);
                    imageURL = url;
                    const img = document.createElement('img');
                    img.src = url;
                    document.body.appendChild(img);
                })
                .catch();
        }

        function downloadFile() {
            var anchorElement = document.createElement('a'); //<a></a>
            anchorElement.href = imageURL;
            anchorElement.download = 'naciasv.png';
            document.body.appendChild(anchorElement);

            anchorElement.click();

            document.body.removeChild(anchorElement);
        }
    </script>


</body>

</html>
