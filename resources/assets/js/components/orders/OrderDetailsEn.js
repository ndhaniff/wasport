import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import CountUp from 'react-countup';
import { Timeline, Icon } from 'antd';

class OrderDetailsEn extends Component{

  constructor(){
    super();
    this.state = {
      orders : window.orders,
      addons : window.addons,
      order_addons : window.order_addons,
      race_title : '',
      order_number : '',
      race_category : '',
      engrave_name : '',
      address_fl : '',
      address_sl : '',
      postal : '',
      city : '',
      state : '',
      phone_number : '',
      race_status : '',
      shipment : '',
      tracking_number : '',
      courier : '',
      price : ''
    }
  }

  componentDidMount() {
    for(var i=0; i<orders.length; i++) {
      if(orders[i]['oid']  == this.props.orderID) {

        this.setState({
          race_title : orders[i]['title_en'],
          order_number : orders[i]['oid'],
          race_category : orders[i]['race_category'],
          engrave_name : orders[i]['engrave_name'],
          address_fl : orders[i]['address_fl'],
          address_sl : orders[i]['address_sl'],
          postal : orders[i]['postal'],
          city : orders[i]['city'],
          state : orders[i]['state'],
          phone_number : orders[i]['phone_number'],
          race_status : orders[i]['race_status'],
          shipment : orders[i]['shipment'],
          tracking_number : orders[i]['tracking_number'],
          courier : orders[i]['courier'],
          price : orders[i]['price']
        })
      }
    }

  }

  createAddonItems() {
      let addonitems = [];

      for(var j=0; j<order_addons.length; j++) {
        for(var k=0; k<addons.length; k++) {
          if(order_addons[j]['addon_id'] == addons[k]['aid'] && order_addons[j]['order_id'] == this.props.orderID) {
              addonitems.push(
                <li>{addons[k]['add_en']} - {order_addons[j]['a_type']}</li>
              )
          }
        }
      }

    return addonitems;
  }

  calculateTotalAmount() {
    let totalAmount = Number(this.state.price)

    for(var j=0; j<order_addons.length; j++) {
      for(var k=0; k<addons.length; k++) {
        if(order_addons[j]['addon_id'] == addons[k]['aid'] && order_addons[j]['order_id'] == this.props.orderID) {
          totalAmount += Number(addons[k]['addprice'])
        }
      }
    }

    totalAmount = totalAmount.toFixed(2)

    return 'RM ' + totalAmount
  }

  render(){

    if(this.state.engrave_name != null) {
      var displayEngrave = <div><span className="orders-subheading">MEDAL ENGRAVING</span><br />
        <span className="orders-desc">{this.state.engrave_name}</span><br /><br /></div>
    } else { var displayEngrave = '' }

    if(this.state.tracking_number != null) {
      var displayTracking = 'TRACKING NUMBER: ' + this.state.tracking_number
    } else { var displayTracking = '' }

    if(this.state.courier != null) {
      var displayCourier = 'COURIER: ' + this.state.courier
    } else { var displayCourier = '' }

    if(this.state.shipment == 'order closed') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER PLACED</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER CLOSED</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'order placed') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER PLACED</Timeline.Item>
        <Timeline.Item color="grey">ORDER CONFIRMED</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'order confirmed') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER PLACED</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER CONFIRMED</Timeline.Item>
        <Timeline.Item color="grey">PACKING</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'order being processed') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER PLACED</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER CONFIRMED</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">PACKING</Timeline.Item>
        <Timeline.Item color="grey">SHIPPED</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'shipped') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER PLACED</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER CONFIRMED</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">PACKING</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">SHIPPED<br />
          {displayTracking} <br />
          {displayCourier}</Timeline.Item>
        <Timeline.Item color="grey">DELIVERED</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'delivered') {
      var displayTimeline = <Timeline>
      <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER PLACED</Timeline.Item>
      <Timeline.Item dot={<Icon type="check-circle" />} color="green">ORDER CONFIRMED</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">PACKING</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">SHIPPED<br />
          {displayTracking} <br />
          {displayCourier}</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">DELIVERED</Timeline.Item>
      </Timeline>
    }

    return(
      <div>
        <center><h4>Order Details</h4></center><br />
        <h5>{this.state.race_title}</h5><br />

        <h6>Status</h6><br />
        {displayTimeline}

        <hr />

        <h6>Details</h6>
        <span className="orders-subheading">ORDER NUMBER</span><br />
        <span className="orders-desc">{this.state.order_number}</span><br /><br />

        <span className="orders-subheading">CATEGORY</span><br />
        <span className="orders-desc">{this.state.race_category}</span><br /><br />

        {displayEngrave}

        <span className="orders-subheading">ITEMS</span><br />
        <span className="orders-desc">
          <ul>
            <li>Medal</li>
            {this.createAddonItems()}
          </ul>
        </span><br />

        <span className="orders-subheading">TOTAL AMOUNT</span><br />
        <span className="orders-desc">{this.calculateTotalAmount()}</span><br /><br />

        <span className="orders-subheading">DELIVERY ADDRESS</span><br />
        <span className="orders-desc">{this.state.address_fl} {this.state.address_sl}<br />
                                      {this.state.postal}  {this.state.city} {this.state.state}</span><br /><br />

        <span className="orders-subheading">PHONE NUMBER</span><br />
        <span className="orders-desc">{this.state.phone_number}</span><br /><br />
      </div>
    )
  }

}

export default OrderDetailsEn
