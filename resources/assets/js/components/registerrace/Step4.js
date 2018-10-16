import React, { Component } from 'react';
import { Form, Button } from 'antd';
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
      add_fl: props.getStore().add_fl,
      add_sl: props.getStore().add_sl,
      city: props.getStore().city,
      state: props.getStore().state,
      postal: props.getStore().postal,
      race_category: props.getStore().race_category,
      engrave_name: props.getStore().engrave_name,
      rid : props.getStore().rid,
      uid : props.getStore().uid,
      addons_selected: props.getStore().addons_selected
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

    let data = new FormData;

    data.append('firstname', this.state.firstname)
    data.append('lastname', this.state.lastname)
    data.append('birthday', this.state.birthday)
    data.append('phone', this.state.phone)
    data.append('gender', this.state.gender)
    data.append('add_fl', this.state.add_fl)
    data.append('add_sl', this.state.add_sl)
    data.append('city', this.state.city)
    data.append('state', this.state.state)
    data.append('postal', this.state.postal)
    data.append('race_category', this.state.race_category)
    data.append('engrave_name', this.state.engrave_name)
    data.append('rid', this.state.rid)
    data.append('uid', this.state.uid)
    data.append('addons_selected', JSON.stringify(this.state.addons_selected))

    axios.post('/user/submitrace',data).then((res) => {
      if(res.data.success){

       MySwal.fire({
         toast: true,
         position: 'top-end',
         showConfirmButton: true,
         type: 'success',
         title: 'Race submitted'
       })

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

    if(typeof this.state.addon_1 != 'undefined') {
      var add_1 = this.state.addon_1
      var add_1_aid = add_1.split(',')[0]
      var add_1_type = add_1.split(',')[1]

      if(add_1_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_1_aid) {
            var add_1_en = addons[i]['add_en'] + ': ' + add_1_type
            var add_1_price = 'RM ' + addons[i]['addprice']
            var addprice_1 = parseFloat(addons[i]['addprice'])
          }
        }
      }
    } else {
      var add_1_en = ''
      var add_1_price = ''
      var addprice_1 = parseFloat("0")
    }

    if(typeof this.state.addon_2 != 'undefined') {
      var add_2 = this.state.addon_2
      var add_2_aid = add_2.split(',')[0]
      var add_2_type = add_2.split(',')[1]

      if(add_2_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_2_aid) {
            var add_2_en = addons[i]['add_en'] + ': ' + add_2_type
            var add_2_price = 'RM ' + addons[i]['addprice']
            var addprice_2 = parseFloat(addons[i]['addprice'])
          }
        }
      }
    } else {
      var add_2_en = ''
      var add_2_price = ''
      var addprice_2 = parseFloat("0")
    }

    if(typeof this.state.addon_3 != 'undefined') {
      var add_3 = this.state.addon_3
      var add_3_aid = add_3.split(',')[0]
      var add_3_type = add_3.split(',')[1]

      if(add_3_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_3_aid) {
            var add_3_en = addons[i]['add_en'] + ': ' + add_3_type
            var add_3_price = 'RM ' + addons[i]['addprice']
            var addprice_3 = parseFloat(addons[i]['addprice'])
          }
        }
      }
    } else {
      var add_3_en = ''
      var add_3_price = ''
      var addprice_3 = parseFloat("0")
    }

    if(typeof this.state.addon_4 != 'undefined') {
      var add_4 = this.state.addon_4
      var add_4_aid = add_4.split(',')[0]
      var add_4_type = add_4.split(',')[1]

      if(add_4_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_4_aid) {
            var add_4_en = addons[i]['add_en'] + ': ' + add_4_type
            var add_4_price = 'RM ' + addons[i]['addprice']
            var addprice_4 = parseFloat(addons[i]['addprice'])
          }
        }
      }
    } else {
      var add_4_en = ''
      var add_4_price = ''
      var addprice_4 = parseFloat("0")
    }

    if(typeof this.state.addon_5 != 'undefined') {
      var add_5 = this.state.addon_5
      var add_5_aid = add_5.split(',')[0]
      var add_5_type = add_5.split(',')[1]

      if(add_5_type != 'none') {
        for(var i=0; i<addons.length; i++) {
          if(addons[i]['aid'] == add_5_aid) {
            var add_5_en = addons[i]['add_en'] + ': ' + add_5_type
            var add_5_price = 'RM ' + addons[i]['addprice']
            var addprice_5 = parseFloat(addons[i]['addprice'])
          }
        }
      }
    } else {
      var add_5_en = ''
      var add_5_price = ''
      var addprice_5 = parseFloat("0")
    }

    let totalAmount = addprice_1 + addprice_2 + addprice_3 + addprice_4 + addprice_5 + parseFloat(this.state.price)
    let totalAmountF = totalAmount.toFixed(2)

    return(
        <div>


        <Form onSubmit={this.handleSubmit}>

          <div className="row">
            <div className="col-sm-9">
              <b>{this.state.title_en}</b><br />
              Category: {this.state.race_category}
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
              RM {this.state.price} <br />
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

          <FormItem {...formItemLayoutWithOutLabel}>
            <Button type="primary" onClick={() => this.jumpToStep(2)} id="register-race-prev">Previous</Button>
            <Button type="primary" htmlType="submit" id="register-race-payment">Make Payment</Button>
          </FormItem>
        </Form>
        </div>
    )
  }
}

const Step4Form = Form.create()(Step4);

export default Step4Form
