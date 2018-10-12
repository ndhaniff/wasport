import React, { Component } from 'react';
import { Form, Input, DatePicker, Select, Button, Radio } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const FormItem = Form.Item;
const Option = Select.Option;
const MySwal = withReactContent(Swal);
const RadioButton = Radio.Button;
const RadioGroup = Radio.Group;

class Step3 extends Component {
  constructor(props) {
    super(props);

    this.state = {
      rid: props.getStore().rid,
      title_en: props.getStore().title_en,
      price: props.getStore().price,
      category: props.getStore().category,
      race_category: props.getStore().race_category,
      engrave: props.getStore().engrave,
      engrave_name: props.getStore().engrave_name,
    };
  }

  componentDidMount() {}

  componentWillUnmount() {}

  createCategoryItems() {
    let category_items = [];
    let category = this.state.category;
    let items = category.split(',')

    for(var i=0; i<items.length; i++) {
      category_items.push(<option key={items[i]} value={items[i]}>{items[i]}</option>);
    }

    return category_items;
  }

  createTypeItems(rid) {
    let type_items = [];

    for(var l=0; l<addons.length; l++) {
      if(addons[l]['rid'] == rid) {

        let type = addons[l]['type'];
        let items = type.split(',')

        for(var k=0; k<items.length; k++) {
          type_items.push(<RadioButton key={items[k]} value={items[k]}>{items[k]}</RadioButton>);
        }
      }
    }

    return type_items;
  }


  jumpToStep(toStep) {
    // We can explicitly move to a step (we -1 as its a zero based index)
    this.props.jumpToStep(toStep); // The StepZilla library injects this jumpToStep utility into each component
  }

  // not required as this component has no forms or user entry
  // isValidated() {}

  handleSelectChange = (value) => { }

  handleRadioChange = (value) => { }

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
          engrave_name: data.engrave_name,
          category: data.category,
          savedToCloud: false // use this to notify step4 that some changes took place and prompt the user to save again
        });

        this.jumpToStep(3)

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

    if(this.state.engrave == 'yes') {
      var engrave_input =
        <FormItem
          {...formItemLayout}
          label={(
            <span>
              Medal Engraving&nbsp;
            </span>
          )}
          hasFeedback
        >
          {getFieldDecorator('engrave_name', {
            rules: [
              { required: true, message: 'Please input your phone number!', whitespace: true },
              { min: 1, message: 'Medal engraving must be at least 1 alphanumeric characters' },
              { max: 15, message: 'Medal engraving must be less than 15 alphanumeric characters' },
            ],
            initialValue: this.state.engrave_name != null ? this.state.engrave_name : ""
          })(
            <Input />
          )}
      </FormItem>
    } else {
      var engrave_input = '';
    }

    if(typeof addons[0] != 'undefined') {
      var addon_radio = []
      var j = 1

      for(var i=0; i<addons.length; i++) {
        addon_radio.push( <FormItem
          {...formItemLayout}
          label=
               {j + '. ' + addons[i]['add_en'] + ': RM' + addons[i]['addprice']}
        >
        {getFieldDecorator('addons', {
          rules: [{message: 'Please select your addon' }],
          initialValue: 'none'
        })(
          <RadioGroup onChange={this.handleRadioChange}>
            <RadioButton value="none">None</RadioButton>
            {this.createTypeItems(addons[i]['rid'])}
          </RadioGroup>
        )}
      </FormItem> )
      j++
      }

    } else {
      var addon_radio = ''
    }

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
          <Button type="primary" onClick={() => this.jumpToStep(1)} id="register-race-prev">Previous</Button>
          <Button type="primary" htmlType="submit" id="register-race-next">Next</Button>
        </FormItem>
      </Form>
    )
  }
}

const Step3Form = Form.create()(Step3);

export default Step3Form
