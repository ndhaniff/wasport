import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import CountUp from 'react-countup';
import OrderModal from './OrderModalZh';

const infoIC = window.location.origin + '/img/ic-info.png';

class OrdersZh extends Component{

  constructor(){
    super();
    this.state = {
      orders : window.orders,
    }
  }

  createOrderItems() {
    let items = [];

    let shipment_status = ''

    for(var i=0; i<orders.length; i++) {
      if(orders[i]['price'] != 0) {

        if(orders[i]['shipment'] == 'order closed') {
          shipment_status = '订单已关闭'
        }

        if(orders[i]['shipment'] == 'order placed') {
          shipment_status = '已下单'
        }

        if(orders[i]['shipment'] == 'order confirmed') {
          shipment_status = '订单已确认'
        }

        if(orders[i]['shipment'] == 'order being processed') {
          shipment_status = '处理订单中'
        }

        if(orders[i]['shipment'] == 'shipped') {
          shipment_status = '订单已发货'
        }

        if(orders[i]['shipment'] == 'delivered') {
          shipment_status = '订单已签收'
        }

        items.push(
          <div>
          <div className="row">
            <div className="col-sm-5">
              <img src={orders[i]['header']} style={{width: '100%'}} />
            </div>
            <div className="col-sm-7">
              <h5>{orders[i]['title_zh']}</h5>
              <p className="orders-info"><img src= {infoIC} />{orders[i]['shipment']}</p>

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

export default OrdersZh

if(document.getElementById('user-orders-zh')){
    ReactDOM.render(<OrdersZh />, document.getElementById('user-orders-zh'))
}
