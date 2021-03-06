import React, { Component } from 'react';
import { Form, Input, DatePicker, Select, Button } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const FormItem = Form.Item;
const Option = Select.Option;
const MySwal = withReactContent(Swal);

class Step2 extends Component {
  constructor(props) {
    super(props);

    this.state = {
      add_fl: props.getStore().add_fl,
      add_sl: props.getStore().add_sl,
      city: props.getStore().city,
      state: props.getStore().state,
      postal: props.getStore().postal
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

  handleSelectChange = (value) => { }

  handleSubmit = (e) => {
    e.preventDefault();
    this.props.form.validateFieldsAndScroll((err, data) => {
      if (!err) {

        this.props.updateStore({
          add_fl: data.add_fl,
          add_sl: data.add_sl,
          city: data.city,
          state: data.state,
          postal: data.postal,
          savedToCloud: false // use this to notify step4 that some changes took place and prompt the user to save again
        });

        MySwal.fire({
          text: 'Please confirm your mailing address is valid and mailable. Address cannot be changed after payment is made.',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          cancelButtonText: 'Back',
          cancelButtonColor: '#d33'
        }).then((result) => {
          if (result.value) {

            this.jumpToStep(2)

          }
        })
      }
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
          <Button type="primary" onClick={() => this.jumpToStep(0)} id="register-race-prev">Previous</Button>
          <Button type="primary" htmlType="submit" id="register-race-next">Next</Button>
        </FormItem>
      </Form>
    )
  }
}

const Step2Form = Form.create()(Step2);

export default Step2Form
