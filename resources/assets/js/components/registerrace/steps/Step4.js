import React, { Component } from 'react';
import { Form, Button, Input } from 'antd';
import moment from 'moment';
import withReactContent from 'sweetalert2-react-content';
import Swal from 'sweetalert2';

const MySwal = withReactContent(Swal);
const FormItem = Form.Item;

class Step4 extends Component {
  constructor(props) {
    super(props);

    this.state = {
      title_en: props.getStore().title_en,
      price: props.getStore().price,
      race_category: props.getStore().race_category,
      addons: props.getStore().addons,
      addon_1: props.getStore().addon_1,
      addon_2: props.getStore().addon_2,
      addon_3: props.getStore().addon_3,
      addon_4: props.getStore().addon_4,
      addon_5: props.getStore().addon_5,
      firstname: props.getStore().firstname,
      lastname: props.getStore().lastname,
      phone: props.getStore().phone,
      gender: props.getStore().gender,
      birthday: props.getStore().birthday,
      email: props.getStore().email,
      add_fl: props.getStore().add_fl,
      add_sl: props.getStore().add_sl,
      city: props.getStore().city,
      state: props.getStore().state,
      postal: props.getStore().postal,
      race_category: props.getStore().race_category,
      engrave_name: props.getStore().engrave_name,
      rid : props.getStore().rid,
      uid : props.getStore().uid,
      addons_selected: props.getStore().addons_selected,
      loading: false,
      totalprice : '',
    };
  }

  componentDidMount() {}

  componentWillUnmount() {}

  jumpToStep(toStep) {
    // We can explicitly move to a step (we -1 as its a zero based index)
    this.props.jumpToStep(toStep); // The StepZilla library injects this jumpToStep utility into each component
  }

  // not required as this component has no forms or user entry
  // isValidated() {}

  handleSubmit = (e) => {
    //Continue to payment gateway
    //Pass the details needed

    e.preventDefault()

    this.setState({loading: true})

    let data = new FormData;

    let race_id = this.state.rid
    let order_firstname = this.state.firstname
    let order_lastname = this.state.lastname
    let order_name = order_lastname + ' ' + order_lastname
    let order_email = this.state.email
    let order_phone = this.state.phone
    let order_amount = e.target.totalprice.value

    data.append('firstname', order_firstname)
    data.append('lastname', order_lastname)
    data.append('email', order_email)
    data.append('phone', order_phone)
    data.append('gender', this.state.gender)
    data.append('birthday', this.state.birthday)
    data.append('add_fl', this.state.add_fl)
    data.append('add_sl', this.state.add_sl)
    data.append('city', this.state.city)
    data.append('state', this.state.state)
    data.append('postal', this.state.postal)
    data.append('race_category', this.state.race_category)
    data.append('engrave_name', this.state.engrave_name)
    data.append('rid', race_id)
    data.append('uid', this.state.uid)
    data.append('addons_selected', JSON.stringify(this.state.addons_selected))
    data.append('order_amount', order_amount)

    //insert to orders table with payment status pending
    axios.post('/user/submitrace',data).then((res) => {
      if(res.data.success){

        this.setState({loading: false})

        let order_id = res.data.oid
        let signature = res.data.hashsign
        let merchantcode = res.data.merchantcode
        let responseURL = res.data.responseURL
        let backendURL = res.data.backendURL

        let order_desc = 'WaSportsRun.com - #' + order_id
        let order_remarks = 'Order for ' + this.state.title_en + ' (Order ID: ' + order_id  +  ')'

        this.props.updateStore({
          MerchantCode: merchantcode,
          RefNo: order_id,
          Amount: order_amount,
          ProdDesc: order_desc,
          UserName: order_name,
          UserEmail: order_email,
          UserContact: order_phone,
          Remark: order_remarks,
          Signature: signature,
          ResponseURL: responseURL,
          BackendURL: backendURL,
          savedToCloud: false // use this to notify step4 that some changes took place and prompt the user to save again
        });

        this.jumpToStep(4)

     } else {
          alert('something wrong')
      }
    }) .catch((error) => {
        // Error
        if (error.response) {
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            console.log(error.response.data);
            console.log(error.response.status);
            console.log(error.response.headers);
        } else if (error.request) {
            // The request was made but no response was received
            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
            // http.ClientRequest in node.js
            console.log(error.request);
        } else {
            // Something happened in setting up the request that triggered an Error
            console.log('Error', error.message);
        }
        console.log(error.config);
    });
  }

  render() {

    const { getFieldDecorator } = this.props.form;

    const formItemLayout = {
      labelCol: {
        xs: { span: 24 },
        sm: { span: 24 },
      },
      wrapperCol: {
        xs: { span: 24 },
        sm: { span: 24 },
      },
    };

    const formItemLayoutWithOutLabel = {
      wrapperCol: {
        xs: { span: 24, offset: 0 },
        sm: { span: 20, offset: 0 },
      },
    };

    if(this.state.loading) {
      var submitBtn = <button className="buttonload" id="register-race-payment"> <i className="fa fa-spinner fa-spin"></i>Loading</button>
    } else {
      var submitBtn = <Button type="primary" htmlType="submit" id="register-race-payment">Make Payment</Button>
    }

    if(typeof this.state.engrave_name != 'undefined') {
      var displayEngrave = 'Medal Engraving: ' + this.state.engrave_name
    } else {
      var displayEngrave = ''
    }

    var price = this.state.price
    var priceF = Number(price).toFixed(2)

    var addprice_1 = 0
    var addprice_2 = 0
    var addprice_3 = 0
    var addprice_4 = 0
    var addprice_5 = 0

    if(typeof this.state.addon_1 != 'undefined') {
      var add_1 = this.state.addon_1
      var add_1_aid = add_1.split(',')[0]
      var add_1_type = add_1.split(',')[1]

      var add_1_en = ''
      var add_1_price = ''

      if(add_1_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_1_aid) {
            var add_1_en = addons[i]['add_en'] + ': ' + add_1_type
            var add_1_price = 'RM ' + Number(addons[i]['addprice']).toFixed(2)
            addprice_1 = Number(addons[i]['addprice'])
          }
        }
      }
    }

    if(typeof this.state.addon_2 != 'undefined') {
      var add_2 = this.state.addon_2
      var add_2_aid = add_2.split(',')[0]
      var add_2_type = add_2.split(',')[1]

      var add_2_en = ''
      var add_2_price = ''

      if(add_2_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_2_aid) {
            var add_2_en = addons[i]['add_en'] + ': ' + add_2_type
            var add_2_price = 'RM ' + Number(addons[i]['addprice']).toFixed(2)
            addprice_2 = Number(addons[i]['addprice'])
          }
        }
      }
    }

    if(typeof this.state.addon_3 != 'undefined') {
      var add_3 = this.state.addon_3
      var add_3_aid = add_3.split(',')[0]
      var add_3_type = add_3.split(',')[1]

      var add_3_en = ''
      var add_3_price = ''

      if(add_3_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_3_aid) {
            var add_3_en = addons[i]['add_en'] + ': ' + add_3_type
            var add_3_price = 'RM ' + Number(addons[i]['addprice']).toFixed(2)
            addprice_3 = Number(addons[i]['addprice'])
          }
        }
      }
    }

    if(typeof this.state.addon_4 != 'undefined') {
      var add_4 = this.state.addon_4
      var add_4_aid = add_4.split(',')[0]
      var add_4_type = add_4.split(',')[1]

      var add_4_en = ''
      var add_4_price = ''

      if(add_4_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_4_aid) {
            var add_4_en = addons[i]['add_en'] + ': ' + add_4_type
            var add_4_price = 'RM ' + Number(addons[i]['addprice']).toFixed(2)
            addprice_4 = Number(addons[i]['addprice'])
          }
        }
      }
    }

    if(typeof this.state.addon_5 != 'undefined') {
      var add_5 = this.state.addon_5
      var add_5_aid = add_5.split(',')[0]
      var add_5_type = add_5.split(',')[1]

      var add_5_en = ''
      var add_5_price = ''

      if(add_5_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_5_aid) {
            var add_5_en = addons[i]['add_en'] + ': ' + add_5_type
            var add_5_price = 'RM ' + Number(addons[i]['addprice']).toFixed(2)
            addprice_5 = Number(addons[i]['addprice'])
          }
        }
      }
    }

    let totalAmount = addprice_1 + addprice_2 + addprice_3 + addprice_4 + addprice_5 + Number(this.state.price)
    let totalAmountF = totalAmount.toFixed(2)

    return(
        <div>

        <Form onSubmit={this.handleSubmit} id="register-step4">

          <div className="row">
            <div className="col-sm-9">
              <b>{this.state.title_en}</b><br />
              Category: {this.state.race_category} <br />
              {displayEngrave}
            </div>

            <div className="col-sm-3"></div>
          </div><br />

          <hr />

          <div className="row">
            <div className="col-sm-9">
              Registration <br />
              {add_1_en} <br />
              {add_2_en} <br />
              {add_3_en} <br />
              {add_4_en} <br />
              {add_5_en} <br />
            </div>

            <div className="col-sm-3" style={{textAlign: 'right'}}>
              RM {priceF} <br />
              {add_1_price} <br />
              {add_2_price} <br />
              {add_3_price} <br />
              {add_4_price} <br />
              {add_5_price} <br />
            </div>
          </div><br />

          <hr />

          <div className="row">
            <div className="col-sm-9">
              Total
            </div>

            <div className="col-sm-3" style={{textAlign: 'right'}}>
              RM  {totalAmountF}
            </div>
          </div><br />

          <hr />

          <span>
            By registering you agree to our <a href="/termsandconditions" target="_blank">terms & conditions</a>
          </span>

          <input type="hidden" name="totalprice" value={totalAmountF}/>

          <FormItem {...formItemLayoutWithOutLabel}>
            <Button type="primary" onClick={() => this.jumpToStep(2)} id="register-race-prev">Previous</Button>
            {submitBtn}
          </FormItem>
        </Form>
        </div>
    )
  }
}

const Step4Form = Form.create()(Step4);

export default Step4Form
