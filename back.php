<!DOCTYPE html>
<html>

<head>
    <title>Add Vocabulary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
    <style>
        html {
            min-height: 100%;
            background: url(https://robe-trotting.com/wp-content/uploads/2019/12/Nepal-Travels-Cover.jpg);
            background-size: cover;
            /* box-shadow:inset 0 0 0 2000px rgba(255, 0, 150, 0.3); */
        }

        .backwala {
            background-image: url('np.jpg');
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(3px);
            -webkit-filter: blur(3px);
        }
    </style>
</head>

<body>
    <div class="backwala">
    </div>
    <div class="container col-md-10 offset-md-1 panel panel-default" style="position:absolute;top:10px;margin-top:10px;box-shadow: 0 0 20px grey;padding:20px; ">
        <h2 class="jumbotron text-center" style="background-color: #005c99;color:white"><b>GRE VOCAB ADD</b> </h2>
        <div id="dictionary">
            <form method="post" id="add_dict">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Word:</label>
                        <input type="text" name="word" placeholder="Eg: Soar" class="form-control additional_title" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Reference (Optional):</label>
                        <input type="text" name="reference" placeholder="Eg: Magoosh" class="form-control additional_title">

                    </div>
                    <div class="form-group col-md-3">
                        <label>Additional Info (Optional):</label>
                        <input type="text" name="add_info" placeholder="Eg: Additional Info" class="form-control additional_title">
                    </div>
                </div>
                <div class=" form-group row">
                    <div id="tags">
                        <input type="text" id="synout" value="" placeholder="Add Synonym words " />
                        <input type="hidden" id="synonym" value="" name="synonym" />
                    </div>
                </div>
                <div class=" form-group row">
                <div class="form-group col-md-3">
                        <label>Antonym:</label>
                        <input type="text" name="antonym" placeholder="Eg: Enter Antonym" class="form-control">
                    </div>
                </div>
                
                <div id="vocab_word">
                    <div class="row row-start">
                        <div class="col-md-5 col-sm-5 subject-grid">
                            <div class="form-group">
                                <label>Answer</label>
                                <textarea type="text" name="answer[]" placeholder="Eg: rocket or sky rocket" class="form-control additional_title"></textarea>

                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <div class="form-group">
                                <label>Example</label>
                                <textarea type="text" name="example[]" placeholder="Eg: Soaring Price/Bird" class="form-control additional_title"></textarea>


                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 mt-4 pt-3">
                            <div class="form-group">
                                <div>

                                    <button onclick="AddButtonClicked(this)" type="button" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" name="add" value="ADD" />
            </form>
        </div>
    </div>

    <script>
        var count = 1;
        $(function() { // DOM ready
          

            function login() {
                var a = prompt("Enter your user ID");
                var b = prompt("Enter your password");
                if (a == "admin" && b == "admin") {
                    // alert("Thank you for visiting");
                } else {
                    alert("Wrong ID or password!!");
                    login();
                }
            }
            login();
            $('#add_dict').submit(function(e) {
                e.preventDefault();
                var synonym;
                syn = document.getElementsByClassName("syn");
                console.log(syn);
                Array.prototype.forEach.call(syn, e => {
                    synonym = synonym ? synonym + "," + e.innerHTML : e.innerHTML;
                });
                
                if (synonym) {
                    document.getElementById("synonym").value = synonym
                    console.log(synonym);

                }
                $.ajax({
                    type: "POST",
                    url: 'upload.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        var jsonData = JSON.parse(response);

                        if (jsonData.success == "1") {
                            document.querySelector("form").reset();
                            document.querySelectorAll(".syn").forEach((e)=>{
                                e.remove();
                            });
                            document.querySelectorAll("#add_row").forEach((e)=>{
                                e.remove();
                            });

                        } else {
                            alert('Upload error !');
                        }
                    }
                });
            });
            // ::: TAGS BOX

            $("#tags input").on({
                focusout: function() {
                    var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig, ''); // allowed characters
                    if (txt) {
                        var innn = `<span class="syn">${txt}</span>`;
                        console.log(innn);
                        $("#tags").append(innn);
                    }

                    this.value = "";
                },
                keyup: function(ev) {
                    // if: comma|enter (delimit more keyCodes with | pipe)
                    if (/(188|13)/.test(ev.which)) $(this).focusout();
                }
            });
            $('#tags').on('click', 'span', function() {
                $(this).remove();
            });

        });

        function AddButtonClicked(thisvar) {
            count++;
            n_row = ` 
                    <div class="row row-start" id="add_row">
                        <div class="col-md-5 col-sm-5 subject-grid">
                            <div class="form-group">
                                <label>Answer</label>
                                <textarea type="text" name="answer[]" placeholder="Eg: rocket or sky rocket" class="form-control additional_title"></textarea>

                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <div class="form-group">
                                <label>Example</label>
                                <textarea type="text" name="example[]" placeholder="Eg: Soaring Price/Bird" class="form-control additional_title"></textarea>


                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 mt-4 pt-3">
                            <div class="form-group">
                                <div>
                                <button onclick="RemoveButtonClicked(this)" type="button" class="btn btn-danger btn-lg"><i class="fa fa-trash"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    `;
            var new_row = document.getElementById("vocab_word");
            console.log('');
            lol = document.getElementById("vocab_word")
            lol.insertAdjacentHTML('beforeend', n_row);
        }

        function RemoveButtonClicked(thisVar) {
            console.log(thisVar);
            count++;
            console.log(hasSomeParentTheClass(thisVar, "row"));
            del_dom = hasSomeParentTheClass(thisVar, "row");
            del_dom.parentElement.removeChild(del_dom);
            console.log("deleted successfully");
        }

        function hasSomeParentTheClass(element, classname) {
            if (element.className.split(' ').indexOf(classname) >= 0) return element;
            return element.parentNode && hasSomeParentTheClass(element.parentNode, classname);
        }
    </script>
</body>

</html>