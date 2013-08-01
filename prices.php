<!DOCTYPE HTML>
    <head>

    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
    <script type="text/javascript" src="js/prices.js"></script>
    <script  src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://huahcoding.com/js/third/jquery.timeago.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/js/bootstrap.min.js">

<!--        <script  src="http://huahcoding.com/js/jquery-1.8.2.min.js"></script>-->
    </head>
<body ng-app="DespScrap" >
<table class="table table-bordered" ng-controller="PricesCtrl">
    <theader>
        <tr>
            <td>id</td>
            <td>total</td>
            <td>base</td>
            <td>taxes</td>
            <td>charges</td>
            <td>when</td>
        </tr>
    </theader>
    <tr ng-repeat="item in prices">
        <td >
            {{ item['web_id'] }}
        </td>
        <td >
            {{ item['price'] }}
        </td>
        <td >
            {{ item['base'] }}
        </td>
        <td >
            {{ item['taxes'] }}
        </td>
        <td >
            {{ item['charges'] }}
        </td>
        <td >
            {{ timeAgo(item['when']) }}
        </td>
    </tr>
</table>

</body>
