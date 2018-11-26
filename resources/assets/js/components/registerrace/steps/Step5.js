import React, { Component } from 'react';
import { Form, Button, Input } from 'antd';
import moment from 'moment';
import withReactContent from 'sweetalert2-react-content';
import Swal from 'sweetalert2';

const MySwal = withReactContent(Swal);
const FormItem = Form.Item;

class Step5 extends Component {
  constructor(props) {
    super(props);

    this.state = {
      MerchantCode: props.getStore().MerchantCode,
      RefNo: props.getStore().RefNo,
      Amount: props.getStore().Amount,
      ProdDesc: props.getStore().ProdDesc,
      UserName: props.getStore().UserName,
      UserEmail: props.getStore().UserEmail,
      UserContact: props.getStore().UserContact,
      Remark: props.getStore().Remark,
      Signature: props.getStore().Signature,
      ResponseURL: props.getStore().ResponseURL,
      BackendURL: props.getStore().BackendURL,
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

  handleSubmit = (e) => {}

  render() {

    return(
        <div>
          You will be directed to the payment page.

          <Form onSubmit={this.handleSubmit} method="post" name="ePayment" action="https://payment.ipay88.com.my/ePayment/entry.asp">
            <Input name="MerchantCode" value={this.state.MerchantCode} />
            <Input name="PaymentId" value="" />
            <Input name="RefNo" value={this.state.RefNo} />
            <Input name="Amount" value={this.state.Amount} />
            <Input name="Currency" value="MYR" />
            <Input name="ProdDesc" value={this.state.ProdDesc} />
            <Input name="UserName" value={this.state.UserName} />
            <Input name="UserEmail" value={this.state.UserEmail} />
            <Input name="UserContact" value={this.state.UserContact} />
            <Input name="Remark" value={this.state.Remark} />
            <Input name="Lang" value="UTF-8" />
            <Input name="SignatureType" value="SHA256" />
            <Input name="Signature" value={this.state.Signature} />
            <Input name="ResponseURL" value={this.state.ResponseURL} />
            <Input name="BackendURL" value={this.state.BackendURL} />
            <Input type="submit" value="Proceed with Payment" name="Submit"/>
          </Form>
        </div>
    )
  }
}

const Step5Form = Form.create()(Step5);

export default Step5Form
