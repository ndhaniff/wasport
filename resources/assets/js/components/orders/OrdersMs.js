import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import CountUp from 'react-countup';
import OrderModal from './OrderModalMs';

const infoIC = window.location.origin + '/img/ic-info.png';

class OrdersMs extends Component{

  constructor(){
    super();
    this.state = {
      orders : window.orders,
    }
  }

  createOrderItems() {
    let items = [];

    for(var i=0; i<orders.length; i++) {
      if(orders[i]['price'] != 0) {

        let shipment_status = ''

        if(orders[i]['shipment'] == 'order closed') {
          shipment_status = 'Pesanan tutup'
        }

        if(orders[i]['shipment'] == 'order placed') {
          shipment_status = 'Pesanan dibuat'
        }

        if(orders[i]['shipment'] == 'order confirmed') {
          shipment_status = 'Pesanan disah'
        }

        if(orders[i]['shipment'] == 'order being processed') {
          shipment_status = 'Pesanan dalam proses'
        }

        if(orders[i]['shipment'] == 'shipped') {
          shipment_status = 'Bungkusan dihantar'
        }

        if(orders[i]['shipment'] == 'delivered') {
          shipment_status = 'Bungkusan diterima'
        }

        items.push(
          <div>
          <div className="row">
            <div className="col-sm-5">
              <img src={orders[i]['header']} style={{width: '100%'}} />
            </div>
            <div className="col-sm-7">
              <h5>{orders[i]['title_ms']}</h5>
              <p className="orders-info"><img src= {infoIC} />{shipment_status}</p>

              <OrderModal orderID = {orders[i]['oid']} />

            </div>
          </div>
          <div id="orders-hr"></div>
          </div>)

      }
    }

    return items;
  }

  render(){

    return(
      <div>
        {this.createOrderItems()}
      </div>
    )
  }

}

export default OrdersMs

if(document.getElementById('user-orders-ms')){
    ReactDOM.render(<OrdersMs />, document.getElementById('user-orders-ms'))
}
