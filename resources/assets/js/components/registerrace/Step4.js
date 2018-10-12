import React, { Component } from 'react';
import { Form, Button } from 'antd';
import moment from 'moment';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const FormItem = Form.Item;

class Step4 extends Component {
  constructor(props) {
    super(props);

    this.state = {};
  }

  componentDidMount() {}

  componentWillUnmount() {}

  calculateTotal() {
    let totalPrice = '';



    return totalPrice;
  }

  jumpToStep(toStep) {
    // We can explicitly move to a step (we -1 as its a zero based index)
    this.props.jumpToStep(toStep); // The StepZilla library injects this jumpToStep utility into each component
  }

  // not required as this component has no forms or user entry
  // isValidated() {}

  handleSubmit = (e) => {
    //Continue to payment gateway
    //Pass the details needed
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
                Race&nbsp;
                </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('title_en', {
              rules: [{
                required: true, message: 'Please input race',
              }],
              initialValue : this.state.title_en
            })(

              <Input disabled={true}/>
            )}
          </FormItem>

          {engrave_input}

          <FormItem
            {...formItemLayout}
            label={(
              <span>
                Category&nbsp;
              </span>
            )}
            hasFeedback
          >
          {getFieldDecorator('race_category', {
            rules: [{ required: true, message: 'Please select your race category!' }],
            initialValue: this.state.race_category != null ? this.state.race_category : ""
          })(
            <Select
              placeholder="Select your race category"
              onChange={this.handleSelectChange}
            >
              {this.createCategoryItems()}
            </Select>
          )}
        </FormItem>

        {addon_radio}

        <FormItem {...formItemLayoutWithOutLabel}>
          <Button type="primary" onClick={() => this.jumpToStep(2)} id="register-race-prev">Previous</Button>
          <Button type="primary" htmlType="submit" id="register-race-next">Make Payment</Button>
        </FormItem>
      </Form>
    )
  }
}

const Step4Form = Form.create()(Step4);

export default Step4Form
