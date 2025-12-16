<div class="row">
    @foreach ($errors->all() as $error)
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    @if ($numbers)
        <div class="levelP pb-2">
            @foreach ($numbers as $key => $number)
                <div class="row align-items-center levelS">
                    <x-form.input col_size="10" type="number" value='{{ $number }}' :label="t_('emergency')"
                        name="numbers[{{ $loop->iteration }}]" />

                    <div class="btn btn-danger col-2" style="margin-top: 25px" onclick="remove(this)"><i
                            class="fa-regular fa-trash-can fs-3" style="margin-right: 10%"></i>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="row align-items-center levelS">
            <x-form.input  col_size="10" value='' type="number" :label="t_('emergency')" name="numbers[0]" />

            <div class="btn btn-danger col-2" style="margin-top: 25px" onclick="remove(this)"><i
                    class="fa-regular fa-trash-can fs-3" style="margin-right: 10%"></i>
            </div>

        </div>


    @endif

    <div>

        <div class="parentIcon" onclick="newLevel()">
            <i class="fa-solid fa-circle-plus"></i>
        </div>

    </div>
</div>



<script>
    function newLevel() {
        count = $(".levelS").length;
        if (count < 10) {
            id = count + 1;
            $(".levelP").append(`
                            <div class="row align-items-center levelS">

                                <x-form.input type="number" col_size="10" value='' :label="t_('emergency')" name="numbers[${id}]" />

                                <div class="btn btn-danger col-2" style="margin-top: 25px" onclick="remove(this)"><i
                                    class="fa-regular fa-trash-can fs-3" style="margin-right: 10%"></i>
                                </div>
                            </div>
`);
        } else {
            $(".parentIcon").css("border-top", "3px solid #f1416c");
            $(".parentIcon i").css("color", "#f1416c");
        }

    }

    function remove(element) {
        $(element).parent().remove();
        count = $(".levelS").length;
        if (count < 10) {
            $(".parentIcon").css("border-top", "3px solid #009ef7");
            $(".parentIcon i").css("color", "#009ef7");
        }
        reOrder()
    }

    function changeColor(element) {
        $(element).next().toggleClass("btn-secondary")
        $(element).next().toggleClass("btn-primary")
    }
</script>

<style>
    .parentIcon {
        border-top: 3px solid #009ef7;
        border-top-right-radius: 25px;
        opacity: 0.5;
        cursor: pointer;
    }

    .parentIcon i {
        color: #009ef7;
        font-size: 35px;
    }

    .parentIcon:hover,
    .parentIcon i :hover {
        opacity: 1;
    }
</style>
