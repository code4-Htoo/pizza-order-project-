$(document).ready(function() {
    //    $.ajax({
    //         type : 'get' ,
    //         url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
    //         dataType : 'json' ,
    //         success : function(response){
    //             console.log(response)
    //         }
    //    })

    $('#sortingOption').change(function() {
        $eventOption = $('#sortingOption').val();

        if ($eventOption == 'asc') {
            $.ajax({
                type: 'get',
                url: '/user/ajax/pizza/list',
                data: { 'status': 'ascending' },
                dataType: 'json',
                success: function(response) {
                    $list = '';
                    for ($i = 0; $i < response.length; $i++) {
                        $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                    <div class="product-item bg-light m-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100 " style="height:280px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate " href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} Kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    }
                    $('#dataList').html($list);
                }
            })

        } else if ($eventOption == 'desc') {
            $.ajax({
                type: 'get',
                url: '/user/ajax/pizza/list',
                data: { 'status': 'descending' },
                dataType: 'json',
                success: function(response) {
                    $list = '';
                    for ($i = 0; $i < response.length; $i++) {
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                            <div class="product-item bg-light m-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100 " style="height:280px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate " href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} Kyats</h5>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }
                    $('#dataList').html($list);
                }
            })
        }
    })

});