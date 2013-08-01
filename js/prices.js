var app = angular.module('DespScrap',[]);

function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}

app.controller('PricesCtrl', function($scope, $http){
    var name = getURLParameter('name');
    var opt = getURLParameter('v');
    $http.get('data/prices.php?name='+name+"&v="+opt).success(function(data){
        $scope.prices= data.data;
    });
    $scope.timeAgo=function(s){
        console.log(s);
        var split = s.split(" ");
        var date = split[0].split("-");
        var time = split[1].split(":");
        var year= date[0], month=date[1], day=date[2];
        var hours= time[0], min=time[1], sec=time[2];
        return jQuery.timeago(
            new Date(year, month-1, day, hours, min, sec, 0)
        );
    }
});

