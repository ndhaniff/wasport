import React from 'react';
import { Form, Input, DatePicker, Select, Button, Upload, Avatar } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const MySwal = withReactContent(Swal);
const FormItem = Form.Item;
const Option = Select.Option;

class Address extends React.Component{
  state = {
    confirmDirty: false,
    id: window.user.id,
    add_fl: window.add_fl,
    add_sl: window.add_sl,
    city: window.city,
    state: window.state,
    postal: window.postal,
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.props.form.validateFieldsAndScroll((err, data) => {
      if (!err) {
       let address = {
        id : window.user.id,
        add_fl : data.add_fl,
        add_sl : data.add_sl,
        city : data.city,
        state : data.state,
        postal : data.postal,
       }

       axios.post('/user/updateAddress',address).then((res) => {
         if(res.data.success){
             /*location.href = location.origin + '/dashboard'
             alert('Address updated')*/

             MySwal.fire({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer: 3000,
               type: 'success',
               title: 'Address updated'
             })

         } else {
             alert('something wrong')
         }
       })
      }
    });
  }

  handleSelectChange = (value) => {

  }

  render(){

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
            label={(
              <span>
                Address Line 1&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('add_fl', {
              rules: [{ required: true, message: 'Please input your address!', whitespace: true }],
              initialValue: this.state.add_fl != null ? this.state.add_fl : ""
            })(
              <Input />
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                Address Line 2&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('add_sl', {
              rules: [{ required: false, whitespace: true }],
              initialValue: this.state.add_sl != null ? this.state.add_sl : ""
            })(
              <Input />
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                City&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('city', {
              rules: [{ required: true, message: 'Please input your city!', whitespace: true }],
              initialValue: this.state.city != null ? this.state.city : ""
            })(
              <Input />
            )}
        </FormItem>
          <FormItem
          {...formItemLayout}
          label="State"
          hasFeedback
        >
          {getFieldDecorator('state', {
            rules: [{ required: true, message: 'Please select your state!' }],
            initialValue: this.state.state != null ? this.state.state : ""
          })(
            <Select
              placeholder="Select your state"
              onChange={this.handleSelectChange}
            >
            <option value="Johor">Johor</option>
            <option value="Kedah">Kedah</option>
            <option value="Kelantan">Kelantan</option>
            <option value="Kuala Lumpur">Kuala Lumpur</option>
            <option value="Labuan">Labuan</option>
            <option value="Melaka">Melaka</option>
            <option value="Negeri Sembilan">Negeri Sembilan</option>
            <option value="Pahang">Pahang</option>
            <option value="Perak">Perak</option>
            <option value="Perlis">Perlis</option>
            <option value="Pulau Pinang">Pulau Pinang</option>
            <option value="Sabah">Sabah</option>
            <option value="Sarawak">Sarawak</option>
            <option value="Selangor">Selangor</option>
            <option value="Terengganu">Terengganu</option>
            </Select>
          )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                Postal&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('postal', {
              rules: [{ required: true, message: 'Please input your postal!', whitespace: true }],
              initialValue: this.state.postal != null ? this.state.postal : ""
            })(
              <Input />
            )}
        </FormItem>
      <FormItem {...formItemLayoutWithOutLabel}>
        <Button type="primary" htmlType="submit">Update Address</Button>
      </FormItem>
    </Form>
    )
  }
}

const AddressForm = Form.create()(Address);

export default AddressForm
