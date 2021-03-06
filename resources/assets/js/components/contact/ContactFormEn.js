import React, { Component } from 'react';
import { Form, Input, Select, Button, Radio } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';
import ReactDOM from 'react-dom';

const MySwal = withReactContent(Swal);
const FormItem = Form.Item;
const Option = Select.Option;
const RadioGroup = Radio.Group;

class ContactFormEn extends React.Component{

  state = {
    confirmDirty: false,
    email: window.user.email,
    name: window.user.name,
    phone: window.user.phone,
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.props.form.validateFieldsAndScroll((err, data) => {
      if (!err) {
       let contact = {
        name : data.name,
        email : data.email,
        phone : data.prefix + data.phone,
        category : data.category,
        message : data.message,
       }
       console.log(contact);

       axios.post('/submitcontact',contact).then((res) => {
         if(res.data.success){

          MySwal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: true,
            confirmButtonColor: '#E02E3C',
            timer: 3000,
            type: 'success',
            title: 'Sent. We will get to you as soon as possible'
          })

          window.setTimeout(function(){
            location.reload();
          } ,3000);

        } else {
             alert('something wrong')
         }
       })
      }
    });
  }

  render(){
    const { getFieldDecorator } = this.props.form;

    const formItemLayout = {
      labelCol: {
        xs: { span: 22 },
        sm: { span: 22 },
      },
      wrapperCol: {
        xs: { span: 22 },
        sm: { span: 22 },
      },
    };

    const formItemLayoutWithOutLabel = {
      wrapperCol: {
        xs: { span: 22, offset: 0 },
        sm: { span: 18, offset: 0 },
      },
    };

    const prefixSelector = getFieldDecorator('prefix', {
      initialValue: '60',
    })(
      <Select style={{ width: 70 }}>
        <Option value="60">+60</Option>
      </Select>
    );

    return(
      <Form onSubmit={this.handleSubmit}>
        <FormItem
            {...formItemLayout}
            label="Name"
            hasFeedback
          >
            {getFieldDecorator('name', {
              rules: [{ required: true, message: 'Please input your name!', whitespace: true }],
              initialValue: this.state.name != null ? this.state.name : ""
            })(
              <Input />
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label="E-mail"
            hasFeedback
          >
            {getFieldDecorator('email', {
              rules: [{
                type: 'email', message: 'The input is not valid E-mail!',
                required: true, message: 'Please input your E-mail!',
              }],
              initialValue: this.state.email != null ? this.state.email : ""
            })(

              <Input/>
            )}
          </FormItem>
          <FormItem
            labelCol = {{
                  xs: { span: 24 },
                  sm: { span: 24 },
                }}
            wrapperCol = {{
                  xs: { span: 26 },
                  sm: { span: 22 },
                }}
            label="Phone Number"
            hasFeedback
          >
            {getFieldDecorator('phone', {
              rules: [
                { required: true, message: 'Please input your phone number!' },
                { min: 9, message: 'Phone number must be at least 11 including prefix' },
                { max: 11, message: 'This is not valid phone number' },
              ],
              initialValue: this.state.phone != null ? this.state.phone.substring(2) : ""
            })(
              <Input addonBefore={prefixSelector} style={{ width: '100%' }} />
          )}
          </FormItem>

          <FormItem
              {...formItemLayout}
              label="Select Category"
              hasFeedback
            >
              {getFieldDecorator('category', {
                rules: [{
                  required: true, message: 'Please select category',
                  onChange: (e) => this.handleChange(e, e.target.value)
                }],

              })(
                <RadioGroup className="contactus-radiogroup" onChange={this.onChange}>
                  <Radio className="contactus-radio" value={'Registration Enquiry'}>Registration Enquiry</Radio>
                  <Radio className="contactus-radio" value={'Account Enquiry'}>Account Enquiry</Radio>
                  <Radio className="contactus-radio" value={'Payment Enquiry'}>Payment Enquiry</Radio>
                  <Radio className="contactus-radio" value={'Shipping Enquiry'}>Shipping Enquiry</Radio>
                  <Radio className="contactus-radio" value={'Appeal'}>Appeal</Radio>
                  <Radio className="contactus-radio" value={'Technical Issues'}>Technical Issues</Radio>
                  <Radio className="contactus-radio" value={'Submit Question'}>Submit Question</Radio>
                  <Radio className="contactus-radio" value={'Other'}>Other</Radio>
                </RadioGroup>
              )}
            </FormItem>

          <FormItem
              {...formItemLayout}
              label="Message"
              hasFeedback
            >
              {getFieldDecorator('message', {
                rules: [{
                  required: true, message: 'Please input message!',
                }],

              })(
                <TextArea rows={4} />
              )}
            </FormItem>

        <FormItem {...formItemLayoutWithOutLabel}>
          <Button type="primary" htmlType="submit">Submit</Button>
        </FormItem>
      </Form>
    )
  }
}

const ContactEn = Form.create()(ContactFormEn);

export default ContactEn

if(document.getElementById('contactform-en')){
    ReactDOM.render(<ContactEn />, document.getElementById('contactform-en'))
}
