import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import CountUp from 'react-countup';
import { Timeline, Icon } from 'antd';

class OrderDetailsZh extends Component{

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
      courier : '',
      tracking_number : '',
      price : ''
    }
  }

  componentDidMount() {
    for(var i=0; i<orders.length; i++) {
      if(orders[i]['oid']  == this.props.orderID) {

        this.setState({
          race_title : orders[i]['title_zh'],
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
          courier : orders[i]['courier'],
          tracking_number : orders[i]['tracking_number'],
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
                <li>{addons[k]['add_zh']} - {order_addons[j]['a_type']}</li>
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
      var displayEngrave = <div><span className="orders-subheading">奖牌雕刻</span><br />
        <span className="orders-desc">{this.state.engrave_name}</span><br /><br /></div>
    } else { var displayEngrave = '' }

    if(this.state.tracking_number != null) {
      var displayTracking = '运单编号: ' + this.state.tracking_number
    } else { var displayTracking = '' }

    if(this.state.courier != null) {
      var displayCourier = '速递: ' + this.state.courier
    } else { var displayCourier = '' }

    if(this.state.shipment == 'order closed') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">已下单</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">订单已关闭</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'order placed') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">已下单</Timeline.Item>
        <Timeline.Item color="grey">订单已确认</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'order confirmed') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">已下单</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">订单已确认</Timeline.Item>
        <Timeline.Item color="grey">处理订单中</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'order being processed') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">已下单</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">订单已确认</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">处理订单中</Timeline.Item>
        <Timeline.Item color="grey">订单已发货</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'shipped') {
      var displayTimeline = <Timeline>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">已下单</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">订单已确认</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">处理订单中</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">订单已发货<br />
          {displayTracking} <br />
          {displayCourier}</Timeline.Item>
      </Timeline>
    }

    if(this.state.shipment == 'delivered') {
      var displayTimeline = <Timeline>
      <Timeline.Item dot={<Icon type="check-circle" />} color="green">已下单</Timeline.Item>
      <Timeline.Item dot={<Icon type="check-circle" />} color="green">订单已确认</Timeline.Item>
      <Timeline.Item dot={<Icon type="check-circle" />} color="green">处理订单中</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">订单已发货<br />
          {displayTracking} <br />
          {displayCourier}</Timeline.Item>
        <Timeline.Item dot={<Icon type="check-circle" />} color="green">订单已签收</Timeline.Item>
      </Timeline>
    }

    return(
      <div>
        <center><h4>订单详情</h4></center><br />
        <h5>{this.state.race_title}</h5><br />

        <h6>状态</h6><br />
        {displayTimeline}

        <hr />

        <h6>Butiran</h6>
        <span className="orders-subheading">订单编号</span><br />
        <span className="orders-desc">{this.state.order_number}</span><br /><br />

        <span className="orders-subheading">类别</span><br />
        <span className="orders-desc">{this.state.race_category}</span><br /><br />

        {displayEngrave}

        <span className="orders-subheading">物件</span><br />
        <span className="orders-desc">
          <ul>
            <li>奖牌</li>
            {this.createAddonItems()}
          </ul>
        </span><br />

        <span className="orders-subheading">总额</span><br />
        <span className="orders-desc">{this.calculateTotalAmount()}</span><br /><br />

        <span className="orders-subheading">收货地址</span><br />
        <span className="orders-desc">{this.state.address_fl} {this.state.address_sl}<br />
                                      {this.state.postal}  {this.state.city} {this.state.state}</span><br /><br />

        <span className="orders-subheading">电话号码</span><br />
        <span className="orders-desc">{this.state.phone_number}</span><br /><br />
      </div>
    )
  }

}

export default OrderDetailsZh
