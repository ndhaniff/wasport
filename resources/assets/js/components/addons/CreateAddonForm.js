import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ReactQuill, {Quill} from 'react-quill';
import Datetime from 'react-datetime';
import Dropzone from 'react-dropzone'
import ImageResize from 'quill-image-resize-module';
import { Tabs, Upload, Icon, Modal } from 'antd';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const MySwal = withReactContent(Swal);
const TabPane = Tabs.TabPane;

Quill.register("modules/imageResize", ImageResize);

export default class CreateAddonForm extends Component {

    constructor(props){
        super(props)
        this.state = {
            add_en : '',
            add_ms : '',
            add_zh : '',
            desc_en : '',
            desc_ms : '',
            desc_zh : '',
            addprice : '',
            type : '',
            races_id: '',
        }

        /* Quill module */
        this.modules = {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline','strike', 'blockquote'],
                [{'align': null}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
                [{ 'color': [] }, { 'background': [] }],
                ['link', 'image'],
                ['clean']
            ],
            imageResize: {
            }
        }

        this.handleDescEnChange = this.handleDescEnChange.bind(this)
        this.handleDescMsChange = this.handleDescMsChange.bind(this)
        this.handleDescZhChange = this.handleDescZhChange.bind(this)
        this.handleInputChange = this.handleInputChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleRaceChange = this.handleRaceChange.bind(this)
    }

    createSelectItems() {
      let items = [];

      for(var i=0; i<races.length; i++) {
        items.push(<option key={races[i]['rid']} value={races[i]['rid']}>{races[i]['title']}</option>);
      }

      return items;
    }

    handleSubmit(e){
        e.preventDefault()

        let {add_en,add_ms,add_zh,desc_en,desc_ms,desc_zh,addprice,type,races_id,aid} = this.state

        let data = new FormData;

        data.append('add_en', add_en)
        data.append('add_ms', add_ms)
        data.append('add_zh', add_zh)
        data.append('desc_en', desc_en)
        data.append('desc_ms', desc_ms)
        data.append('desc_zh', desc_zh)
        data.append('addprice', addprice)
        data.append('type', type)
        data.append('races_id', races_id)

        let message = [];
        let messageF = '';

        if(add_ms === '') { message.push('Title(MS)') }
        if(add_zh === '') { message.push('Title(ZH)') }
        if(desc_ms.length == 0) { message.push('Description(MS)') }
        if(desc_zh.length == 0) { message.push('Description(ZH)') }
        if(type === '') { message.push('Type') }

        messageF = message.join(', ')

        if(message.length != 0) {

          MySwal.fire({
            title: 'These fields are empty',
            text: messageF,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Create addon anyway',
            cancelButtonText: 'Cancel',
            cancelButtonColor: '#d33'
          }).then((result) => {
            if (result.value) {

              axios.post('/admin/addons/create',data).then((res) => {
                  if(res.data.success){
                      /*location.href = location.origin + '/admin/addons/edit/'+res.data.id
                      alert('Addon added')*/

                      MySwal.fire({
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        type: 'success',
                        title: 'Addon added'
                      })

                      window.setTimeout(function(){
                        location.href = location.origin + '/admin/addons/edit/'+res.data.aid
                      } ,3000);

                  } else {
                      alert('something wrong')
                  }
              })

            }
          })

        } else {

          axios.post('/admin/addons/create',data).then((res) => {
              if(res.data.success){
                  /*location.href = location.origin + '/admin/addons/edit/'+res.data.id
                  alert('Addon added')*/

                  MySwal.fire({
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    type: 'success',
                    title: 'Addon added'
                  })

                  window.setTimeout(function(){
                    location.href = location.origin + '/admin/addons/edit/'+res.data.aid
                  } ,3000);

              } else {
                  alert('something wrong')
              }
          })

        }

    }

    handleDescEnChange(data){
        this.setState({ desc_en: data })
    }
    handleDescMsChange(data){
        this.setState({ desc_ms: data })
    }
    handleDescZhChange(data){
        this.setState({ desc_zh: data })
    }

    handleInputChange({target: {value,name}}){
        this.setState({
            [name] : value
        })
    }

    handleRaceChange(event) {
      this.setState({races_id: event.target.value});
    }

    handleChange = ({ fileList }) => this.setState({ fileList })

    render() {

      return (

            <div className="wrapper p-1">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header">Create Addon</div>

                            <div className="card-body">
                                <form onSubmit={this.handleSubmit}>

                                    <div className="form-group">
                                        <Tabs defaultActiveKey="1" type="card">
                                            <TabPane tab="En" key="1">
                                                <label htmlFor="addtitle_en">Addon Title<span className="required-field">*</span></label>
                                                <input onChange={this.handleInputChange} name="add_en" className="form-control" type="text" id="addtitle_en" required/>
                                            </TabPane>
                                            <TabPane tab="Ms" key="2">
                                                <label htmlFor="addtitle_ms">Addon Title</label>
                                                <input onChange={this.handleInputChange} name="add_ms" className="form-control" type="text" id="addtitle_ms"/>
                                            </TabPane>
                                            <TabPane tab="Zh" key="3">
                                                <label htmlFor="addtitle_zh">Addon Title</label>
                                                <input onChange={this.handleInputChange} name="add_zh" className="form-control" type="text" id="addtitle_zh" />
                                            </TabPane>
                                        </Tabs>
                                    </div>

                                    <div className="form-group">
                                      <div className="form-row">
                                        <div className="col-sm-12 col-md-4">
                                          <div className="form-group">
                                            <label>Type <span>(seperate with ',')</span></label>
                                            <input onChange={this.handleInputChange} name="type" className="form-control" type="text" />
                                          </div>
                                        </div>

                                        <div className="col-sm-12 col-md-4">
                                          <div className="form-group">
                                            <label>Price<span className="required-field">*</span></label>
                                            <input onChange={this.handleInputChange} name="addprice" className="form-control" type="text" />
                                          </div>
                                        </div>

                                        <div className="col-sm-12 col-md-4">
                                          <div className="form-group">
                                            <label>Race Title<span className="required-field">*</span></label>
                                            <select value={this.state.races_id} onChange={this.handleRaceChange} style={{'display': 'block'}} className="form-select">
                                              <option disabled selected value=""> -- select an option -- </option>
                                              {this.createSelectItems()}
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div className="form-group">
                                    <Tabs defaultActiveKey="1" type="card">
                                        <TabPane tab="En" key="1">
                                            <label htmlFor="desc">Description<span className="required-field">*</span></label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.desc_en} onChange={this.handleDescEnChange} />
                                            <input type="hidden" name="desc_en" value={this.state.desc_en}/>
                                        </TabPane>
                                        <TabPane tab="Ms" key="2">
                                            <label htmlFor="desc">Description</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.desc_ms} onChange={this.handleDescMsChange} />
                                            <input type="hidden" name="desc_ms" value={this.state.desc_ms}/>
                                        </TabPane>
                                        <TabPane tab="Zh" key="3">
                                            <label htmlFor="desc">Description</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.desc_zh} onChange={this.handleDescZhChange} />
                                            <input type="hidden" name="desc_zh" value={this.state.desc_zh}/>
                                        </TabPane>
                                    </Tabs>
                                    </div><br/><br/>
                                    <button className="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if(document.getElementById('createaddonform')){
    ReactDOM.render(<CreateAddonForm />, document.getElementById('createaddonform'))
}
