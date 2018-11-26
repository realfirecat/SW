app.component("sendUsername", {
    templateUrl: "components/send-username.html",
    controller: "SendUsernameController"
});

app.controller("SendUsernameController", function($http){
    this.status = "You did not submit anything yet.";

    this.submit = () => {
        let parameter = JSON.stringify({username:this.frm_username});
        let  url = "http://localhost/ServiceDemos/AjaxVanillaJS/register.php";

        $http({
            method: 'POST',
            url: url,
            data: parameter
        }).then(
            (response) => {
            console.log(response);
            this.status = response.data.infotext;
        },function (error){
            console.log(error);
        });
    }
});