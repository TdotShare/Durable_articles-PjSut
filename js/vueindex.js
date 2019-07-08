
CheckLogin();

var vueIndex = new Vue({
    el: '#vueIndex',
    data: {
        Session: false,
        StatusAccount: "",
        ShowAccount: "",
        TempItemKharu: {},
        ItemKharu: [],
        DetailSet: [],
        SetImage: "",
        SetAccont: "",
        setname: "",

    },
    methods: {
        ScanFindItem: function (set) {

            if (set == 1) {
                vueIndex.ItemKharu = [];

                var Idkharu = document.getElementById('lifeScanIdkharu').value
                var AssetTyp = document.getElementById('lifeScanAssetType').value
                var ScanDate = document.getElementById('lifeScanDate').value
                var Caretaker = document.getElementById('lifeScanCaretaker').value

                const params = new URLSearchParams();
                params.append('check', "scanwhere");
                params.append('Idkharu', Idkharu);
                params.append('AssetTyp', AssetTyp);
                params.append('ScanDate', ScanDate);
                params.append('Caretaker', Caretaker);

                axios.post('php/getitem.php', params).then(function (response) {

                    console.log(response.data);

                    if (response.data != null) {

                        for (let index = 0; index < response.data.length; index++) {

                            vueIndex.ItemKharu.push(response.data[index]);
                        }

                    } else {

                    }
                });

            } else {

                vueIndex.TempItemKharu = [];

                var Idkharu = document.getElementById('TempScanIdkharu').value
                var AssetTyp = document.getElementById('TempScanAssetType').value
                var ScanDate = document.getElementById('TempScanDate').value
                var Caretaker = document.getElementById('TempScanCaretaker').value
                var ScanSave = document.getElementById('TempScanSave').value

                const params = new URLSearchParams();
                params.append('check', "scanwhere2");
                params.append('Idkharu', Idkharu);
                params.append('AssetTyp', AssetTyp);
                params.append('ScanDate', ScanDate);
                params.append('Caretaker', Caretaker);
                params.append('ScanSave', ScanSave);

                axios.post('php/getitem.php', params).then(function (response) {

                    console.log(response.data);

                    if (response.data != null) {

                        for (let index = 0; index < response.data.length; index++) {

                            vueIndex.TempItemKharu.push(response.data[index]);
                        }

                    } else {

                    }
                });



            }




        },
        SetViewModelKharu: function (Ik) {
            
           
           // document.getElementById("idkharuShow").value = TempIk.id_kharu;
            
            document.getElementById('brandShow').value = Ik.brand;
            document.getElementById('serial_numberShow').value = Ik.serial_number;
            document.getElementById('priceShow').value = Ik.price;
            document.getElementById('order_numberShow').value = Ik.order_number;
            document.getElementById('roomShow').value = Ik.room;
            document.getElementById('statusShow').value = Ik.status;
            document.getElementById('noteShow').value = Ik.note;
            document.getElementById('date_startShow').value = Ik.date_start;
            
            

            //this.SetImage = TempIk.image;
            //this.SetAccont = TempIk.account_number;

        },

        SetShowModelKharu: function (TempIk, index) {
            document.getElementById('idkharuEdit').value = TempIk.id_kharu;
            document.getElementById('asset_typeEdit').value = TempIk.asset_type
            document.getElementById('brandEdit').value = TempIk.brand;
            document.getElementById('brandEdit').value = TempIk.brand;
            document.getElementById('serial_numberEdit').value = TempIk.serial_number;
            document.getElementById('priceEdit').value = TempIk.price;
            document.getElementById('order_numberEdit').value = TempIk.order_number;
            document.getElementById('roomEdit').value = TempIk.room;
            document.getElementById('statusEdit').value = TempIk.status;
            document.getElementById('noteEdit').value = TempIk.note;
            document.getElementById('tempEdit').value = TempIk.temp;
            document.getElementById('date_startEdit').value = TempIk.date_start;
            document.getElementById('CaretakerEdit').value = TempIk.caretaker;
            this.SetImage = TempIk.image;
            this.SetAccont = TempIk.account_number;
        },

        SetShowUi(name) {
            vueIndex.setname = name;
        },
    }
});



function EditKharu() {
    var idkharuEdit = document.getElementById('idkharuEdit').value;
    var asset_typeEdit = document.getElementById('asset_typeEdit').value;
    var brandEdit = document.getElementById('brandEdit').value;
    var serial_numberEdit = document.getElementById('serial_numberEdit').value;
    var priceEdit = document.getElementById('priceEdit').value;
    var order_numberEdit = document.getElementById('order_numberEdit').value;
    var roomEdit = document.getElementById('roomEdit').value;
    var statusEdit = document.getElementById('statusEdit').value;
    var noteEdit = document.getElementById('noteEdit').value;
    var tempEdit = document.getElementById('tempEdit').value;
    var dateStart = document.getElementById('date_startEdit').value;
    var CaretaerEdit = document.getElementById('CaretakerEdit').value

    const params = new URLSearchParams();
    params.append('check', "add");

    params.append('id_kharu', idkharuEdit);
    params.append('asset_type', asset_typeEdit);
    params.append('date_strat', dateStart);
    params.append('brand', brandEdit);
    params.append('sn', serial_numberEdit);
    params.append('price', priceEdit);
    params.append('order', order_numberEdit);
    params.append('room', roomEdit);
    params.append('status', statusEdit);
    params.append('note', noteEdit);
    params.append('user', vueIndex.SetAccont);
    params.append('image', vueIndex.SetImage);
    params.append('caretaker', CaretaerEdit);




    axios.post('php/getitem.php', params).then(function (response) {

        console.log(response.data);

        if (response.data == "Suss") {

            GetViewKharu();
            SetViewKharu();

            swal("", "เปลี่ยนแปลงฐานข้อมูล เรียบร้อย", "success");

        } else {
            swal("", "ไม่พบข้อมูล", "info");
        }

    });




}
function SetViewKharu() {
    vueIndex.ItemKharu = [];
    const params = new URLSearchParams();
    params.append('check', "notemp");

    axios.post('php/getitem.php', params).then(function (response) {

        console.log(response.data);

        if (response.data != null) {

            for (let index = 0; index < response.data.length; index++) {

                vueIndex.ItemKharu.push(response.data[index]);
            }

        } else {
            //alert('ไม่พบข้อมูลของครุภัณฑ์ในฐานข้อมูลสำรอง');
        }
    });


}


function GetViewKharu() {

    vueIndex.TempItemKharu = [];

    const params = new URLSearchParams();
    params.append('check', "scan");

    axios.post('php/getitem.php', params).then(function (response) {

        console.log(response.data);

        if (response.data != "null") {

            for (let index = 0; index < response.data.length; index++) {

                vueIndex.TempItemKharu.push(response.data[index]);
            }

        } else {
            //alert('ไม่พบข้อมูลของครุภัณฑ์ในฐานข้อมูลสำรอง');
        }
    });

    //console.log(vueIndex.TempItemKharu);
}

function CheckLogin() {
    axios.post('php/SessionLogin.php').then(function (response) {
        console.log(response.data);
        if (response.data == false) {
            window.location.href = "./login.html";
            alert("ยังไม่มีการล็อคอิน !");
        } else {
            console.log('ByPass');
            GetViewKharu();
            SetViewKharu();
            //
        }
    });
}