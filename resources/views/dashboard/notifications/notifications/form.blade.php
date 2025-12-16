<x-form route="dashboard.notifications.notifications" :title="t_('notifications')">

    @foreach ($errors?->all() ?? [] as $error)
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach

    <x-form.input name="title" :label="t_('message title')" />
    <x-form.input name="message" :label="t_('message')" />


    <div class="row">

        <x-form.select :multiple="true" col_size="6" name="receiver_types[]" id="receiver_types" :options="$receiver_types"
            :label="t_('receiver_types')" />

        <x-form.select :multiple="true" col_size="6" name="receivers[]" :options="[]" id="receivers"
            :label="t_('receivers')" />

    </div>

</x-form>

<div id="shadow" class="d-none position-fixed w-100 h-100 d-flex justify-content-center align-items-center">
    <div class=" lds-facebook">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>


<style>
    #shadow {
        background: transparent;
        z-index: 9999999999999;
    }

    .lds-facebook {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        z-index: 15;
    }

    .lds-facebook div {
        display: inline-block;
        position: absolute;
        left: 8px;
        width: 16px;
        background: #fff;
        animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    }

    .lds-facebook div:nth-child(1) {
        left: 8px;
        animation-delay: -0.24s;
    }

    .lds-facebook div:nth-child(2) {
        left: 32px;
        animation-delay: -0.12s;
    }

    .lds-facebook div:nth-child(3) {
        left: 56px;
        animation-delay: 0;
    }

    @keyframes lds-facebook {
        0% {
            top: 8px;
            height: 64px;
        }

        50%,
        100% {
            top: 24px;
            height: 32px;
        }
    }
</style>

<script>
    $("#receiver_types").on("change", (x) => {
        ids = [];
        elements = x.target.children;
        elements.forEach(function(element) {
            selects = $(".select2-selection__choice");
            selects.each(function(index, selected) {
                if (element.innerText == selected.innerText) {
                    ids.push(element.value)
                }
            })
        })

        $("#shadow").toggleClass("d-none");
        $.ajax({
            url: `{{ route('dashboard.ajaxGetReceivers') }}`,
            type: "Post",
            dataType: 'JSON',
            data: {
                "receiver_types": ids
            },
            success: function(res) {
                data = res.data
                $("#shadow").toggleClass("d-none");
                $("#receivers").children().remove()
                if (data.length > 0) {

                    $("#receivers").append(
                        `<option value="0">{{ t_('all') }}<option/>`)
                    data.forEach(el => {
                        $("#receivers").append(
                            `<option value="${el.id}">${el.name}<option/>`)
                    });
                }

            },

            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $("#shadow").toggleClass("d-none");
                $("#receivers").children().remove()
//                alert("Status: " + textStatus);
            }

        });

    });
</script>
