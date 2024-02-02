$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2017 Q1',
            Company: 22,
            Retailer: 34,
            service: 54
        }, {
            period: '2018 Q1',
            Company: 22,
            Retailer: 33,
            service: 11
        },{
            period: '2019 Q1',
            Company: 11,
            Retailer: 22,
            service: 33
        }
        ],
        xkey: 'period',
        ykeys: ['Company', 'Retailer', 'service'],
        labels: ['Company', 'Retailer', 'service'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });


    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Dealer Order",
            value: 20
        }, {
            label: "Customer Order",
            value: 40
        }, {
            label: "Service Order",
            value: 40
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{

                y: '2017',
                GuitarWorld: 23,
                Dealer: 233
            },
            {
            y: '2018',
            GuitarWorld: 33,
            Dealer: 44
        }, {
            y: '2019',
            GuitarWorld: 55,
            Dealer: 66
        }, {
            y: '2020',
            GuitarWorld: null,
            Dealer: null
        }, {
            y: '2021',
            GuitarWorld: null,
            Dealer: null
        }, {
            y: '2022',
            GuitarWorld: null,
            Dealer: null
        }, {
            y: '2023',
            GuitarWorld: null,
            Dealer: null
        }],
        xkey: 'y',
        ykeys: ['GuitarWorld', 'Dealer'],
        labels: ['GuitarWorld', 'Dealer'],
        hideHover: 'auto',
        resize: true
    });
    
});
