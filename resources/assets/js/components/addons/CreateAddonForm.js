import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ReactQuill, {Quill} from 'react-quill';
import Datetime from 'react-datetime';
import Dropzone from 'react-dropzone'
import ImageResize from 'quill-image-resize-module';
import { Tabs } from 'antd';
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
            descimg_1: [],
            descimg_2: [],
            descimg_3: [],
            descimg_4: [],
            descimg_5: [],
            descimg_6: [],
            toggleDrop_descimg_1: true,
            toggleDrop_descimg_2: true,
            toggleDrop_descimg_3: true,
            toggleDrop_descimg_4: true,
            toggleDrop_descimg_5: true,
            toggleDrop_descimg_6: true,
            show_descimg_2: false,
            show_descimg_3: false,
            show_descimg_4: false,
            show_descimg_5: false,
            show_descimg_6: false,
        }

        /* Quill module */
        this.modules = {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline','strike', 'blockquote'],
                [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
                [{ 'color': [] }, { 'background': [] }],
                ['link'],
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

        this.onDrop_descimg_1 = this.onDrop_descimg_1.bind(this)
        this.onDrop_descimg_2 = this.onDrop_descimg_2.bind(this)
        this.onDrop_descimg_3 = this.onDrop_descimg_3.bind(this)
        this.onDrop_descimg_4 = this.onDrop_descimg_4.bind(this)
        this.onDrop_descimg_5 = this.onDrop_descimg_5.bind(this)
        this.onDrop_descimg_6 = this.onDrop_descimg_6.bind(this)

        this.removePreview_descimg_1 = this.removePreview_descimg_1.bind(this)
        this.removePreview_descimg_2 = this.removePreview_descimg_2.bind(this)
        this.removePreview_descimg_3 = this.removePreview_descimg_3.bind(this)
        this.removePreview_descimg_4 = this.removePreview_descimg_4.bind(this)
        this.removePreview_descimg_5 = this.removePreview_descimg_5.bind(this)
        this.removePreview_descimg_6 = this.removePreview_descimg_6.bind(this)
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

        let {add_en,add_ms,add_zh,desc_en,desc_ms,desc_zh,descimg_1,descimg_2,descimg_3,descimg_4,descimg_5,descimg_6,addprice,type,races_id,aid} = this.state

        let addpriceF = '';
        addpriceF = parseFloat(addprice).toFixed(2)

        let data = new FormData;

        data.append('add_en', add_en)
        data.append('add_ms', add_ms)
        data.append('add_zh', add_zh)
        data.append('desc_en', desc_en)
        data.append('desc_ms', desc_ms)
        data.append('desc_zh', desc_zh)
        data.append('addprice', addpriceF)
        data.append('type', type)
        data.append('races_id', races_id)
        data.append('descimg_1', descimg_1[0])
        data.append('descimg_2', descimg_2[0])
        data.append('descimg_3', descimg_3[0])
        data.append('descimg_4', descimg_4[0])
        data.append('descimg_5', descimg_5[0])
        data.append('descimg_6', descimg_6[0])

        let message = [];
        let messageF = '';
        let desc_img = [];

        if(add_ms === '') { message.push('Title(MS)') }
        if(add_zh === '') { message.push('Title(ZH)') }
        if(desc_en.length == 0) { message.push('Description(EN)') }
        if(desc_ms.length == 0) { message.push('Description(MS)') }
        if(desc_zh.length == 0) { message.push('Description(ZH)') }
        if(type === '') { message.push('Type') }

        if(typeof descimg_1[0] != 'undefined') { desc_img.push(descimg_1[0])}
        if(typeof descimg_2[0] != 'undefined') { desc_img.push(descimg_2[0])}
        if(typeof descimg_3[0] != 'undefined') { desc_img.push(descimg_3[0])}
        if(typeof descimg_4[0] != 'undefined') { desc_img.push(descimg_4[0])}
        if(typeof descimg_5[0] != 'undefined') { desc_img.push(descimg_5[0])}
        if(typeof descimg_6[0] != 'undefined') { desc_img.push(descimg_6[0])}
        if(desc_img.length == 0) {message.push('Addon Image')}

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

    onDrop_descimg_1(acceptedFiles, rejectedFiles) {
        this.setState({descimg_1: acceptedFiles,toggleDrop_descimg_1:false,show_descimg_2:true})
    }

    onDrop_descimg_2(acceptedFiles, rejectedFiles) {
        this.setState({descimg_2: acceptedFiles,toggleDrop_descimg_2:false,show_descimg_3:true})
    }

    onDrop_descimg_3(acceptedFiles, rejectedFiles) {
        this.setState({descimg_3: acceptedFiles,toggleDrop_descimg_3:false,show_descimg_4:true})
    }

    onDrop_descimg_4(acceptedFiles, rejectedFiles) {
        this.setState({descimg_4: acceptedFiles,toggleDrop_descimg_4:false,show_descimg_5:true})
    }

    onDrop_descimg_5(acceptedFiles, rejectedFiles) {
        this.setState({descimg_5: acceptedFiles,toggleDrop_descimg_5:false,show_descimg_6:true})
    }

    onDrop_descimg_6(acceptedFiles, rejectedFiles) {
        this.setState({descimg_6: acceptedFiles,toggleDrop_descimg_6:false})
    }

    removePreview_descimg_1(){
        this.setState({descimg_1: [],toggleDrop_descimg_1:true})
    }

    removePreview_descimg_2(){
        this.setState({descimg_2: [],toggleDrop_descimg_2:true})
    }

    removePreview_descimg_3(){
        this.setState({descimg_3: [],toggleDrop_descimg_3:true})
    }

    removePreview_descimg_4(){
        this.setState({descimg_4: [],toggleDrop_descimg_4:true})
    }

    removePreview_descimg_5(){
        this.setState({descimg_5: [],toggleDrop_descimg_5:true})
    }

    removePreview_descimg_6(){
        this.setState({descimg_6: [],toggleDrop_descimg_6:true})
    }

    render() {

      //descimg 1
      if(this.state.descimg_1.length != 0){
          var previewImg_descimg_1 =  <div className="mb-2 text-center"><button onClick={this.removePreview_descimg_1} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.descimg_1[0].preview} alt=""/></div>
      } else { var previewImg_descimg_1 =  <img src="" alt=""/> }

      if(this.state.toggleDrop_descimg_1){
          var dropzone_descimg_1 =
            <Dropzone
              className="dropzone-style"
              accept="image/jpeg, image/png"
              onDrop={this.onDrop_descimg_1}
              multiple={false}
              name="descimg_1">
            <div className="text-center">
              <p>Try dropping some files here, or click to select files to upload.</p>
              <p>Only *.jpeg and *.png images will be accepted</p>
            </div>
            </Dropzone>
      } else { var dropzone_descimg_1 = "" }

      //descimg 2
      if(this.state.descimg_2.length != 0){
          var previewImg_descimg_2 =  <div className="mb-2 text-center"><button onClick={this.removePreview_descimg_2} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.descimg_2[0].preview} alt=""/></div>
      } else { var previewImg_descimg_2 =  <img src="" alt=""/> }

      if(this.state.toggleDrop_descimg_2){
          var dropzone_descimg_2 =
            <Dropzone
              className="dropzone-style"
              style={{"display": this.state.show_descimg_2 ? 'block' : 'none'}}
              accept="image/jpeg, image/png"
              onDrop={this.onDrop_descimg_2}
              multiple={false}
              name="descimg_2">
            <div className="text-center">
              <p>Try dropping some files here, or click to select files to upload.</p>
              <p>Only *.jpeg and *.png images will be accepted</p>
            </div>
            </Dropzone>
        } else { var dropzone_descimg_2 = "" }

        //descimg 3
        if(this.state.descimg_3.length != 0){
            var previewImg_descimg_3 =  <div className="mb-2 text-center"><button onClick={this.removePreview_descimg_3} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.descimg_3[0].preview} alt=""/></div>
        } else { var previewImg_descimg_3 =  <img src="" alt=""/> }

        if(this.state.toggleDrop_descimg_3){
            var dropzone_descimg_3 =
              <Dropzone
                className="dropzone-style"
                style={{"display": this.state.show_descimg_3 ? 'block' : 'none'}}
                accept="image/jpeg, image/png"
                onDrop={this.onDrop_descimg_3}
                multiple={false}
                name="descimg_3">
              <div className="text-center">
                <p>Try dropping some files here, or click to select files to upload.</p>
                <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
              </Dropzone>
        } else { var dropzone_descimg_3 = "" }

        //descimg 4
        if(this.state.descimg_4.length != 0){
            var previewImg_descimg_4 =  <div className="mb-2 text-center"><button onClick={this.removePreview_descimg_4} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.descimg_4[0].preview} alt=""/></div>
        } else { var previewImg_descimg_4 =  <img src="" alt=""/> }

        if(this.state.toggleDrop_descimg_4){
            var dropzone_descimg_4 =
              <Dropzone
                className="dropzone-style"
                style={{"display": this.state.show_descimg_4 ? 'block' : 'none'}}
                accept="image/jpeg, image/png"
                onDrop={this.onDrop_descimg_4}
                multiple={false}
                name="descimg_4">
              <div className="text-center">
                <p>Try dropping some files here, or click to select files to upload.</p>
                <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
              </Dropzone>
        } else { var dropzone_descimg_4 = "" }

        //descimg 5
        if(this.state.descimg_5.length != 0){
            var previewImg_descimg_5 =  <div className="mb-2 text-center"><button onClick={this.removePreview_descimg_5} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.descimg_5[0].preview} alt=""/></div>
        } else { var previewImg_descimg_5 =  <img src="" alt=""/> }

        if(this.state.toggleDrop_descimg_5){
            var dropzone_descimg_5 =
              <Dropzone
                className="dropzone-style"
                style={{"display": this.state.show_descimg_5 ? 'block' : 'none'}}
                accept="image/jpeg, image/png"
                onDrop={this.onDrop_descimg_5}
                multiple={false}
                name="descimg_5">
              <div className="text-center">
                <p>Try dropping some files here, or click to select files to upload.</p>
                <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
              </Dropzone>
        } else { var dropzone_descimg_5 = "" }

        //descimg 6
        if(this.state.descimg_6.length != 0){
            var previewImg_descimg_6 =  <div className="mb-2 text-center"><button onClick={this.removePreview_descimg_6} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.descimg_6[0].preview} alt=""/></div>
        } else { var previewImg_descimg_6 =  <img src="" alt=""/> }

        if(this.state.toggleDrop_descimg_6){
            var dropzone_descimg_6 =
              <Dropzone
                className="dropzone-style"
                style={{"display": this.state.show_descimg_6 ? 'block' : 'none'}}
                accept="image/jpeg, image/png"
                onDrop={this.onDrop_descimg_6}
                multiple={false}
                name="descimg_6">
              <div className="text-center">
                <p>Try dropping some files here, or click to select files to upload.</p>
                <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
              </Dropzone>
          } else { var dropzone_descimg_6 = "" }


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
                                              <label htmlFor="addtitle_en">Addon Title (EN)<span className="required-field">*</span></label>
                                              <input onChange={this.handleInputChange} name="add_en" className="form-control" type="text" id="addtitle_en" required/>
                                          </TabPane>
                                          <TabPane tab="Ms" key="2">
                                              <label htmlFor="addtitle_ms">Addon Title (MS)</label>
                                              <input onChange={this.handleInputChange} name="add_ms" className="form-control" type="text" id="addtitle_ms"/>
                                          </TabPane>
                                          <TabPane tab="Zh" key="3">
                                              <label htmlFor="addtitle_zh">Addon Title (ZH)</label>
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
                                          <input onChange={this.handleInputChange} name="addprice" className="form-control" type="text" required/>
                                        </div>
                                      </div>

                                      <div className="col-sm-12 col-md-4">
                                        <div className="form-group">
                                          <label>Race Title<span className="required-field">*</span></label>
                                          <select value={this.state.races_id} onChange={this.handleRaceChange} style={{'display': 'block'}} className="form-select" required>
                                            <option disabled value=""> -- select an option -- </option>
                                            {this.createSelectItems()}
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div className="form-group">
                                  <Tabs defaultActiveKey="1" type="card">
                                      <TabPane tab="En" key="1">
                                          <label htmlFor="desc">Description (EN)<span className="required-field">*</span></label>
                                          <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.desc_en} onChange={this.handleDescEnChange} />
                                          <input type="hidden" name="desc_en" value={this.state.desc_en}/>
                                      </TabPane>
                                      <TabPane tab="Ms" key="2">
                                          <label htmlFor="desc">Description (MS)</label>
                                          <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.desc_ms} onChange={this.handleDescMsChange} />
                                          <input type="hidden" name="desc_ms" value={this.state.desc_ms}/>
                                      </TabPane>
                                      <TabPane tab="Zh" key="3">
                                          <label htmlFor="desc">Description (ZH)</label>
                                          <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.desc_zh} onChange={this.handleDescZhChange} />
                                          <input type="hidden" name="desc_zh" value={this.state.desc_zh}/>
                                      </TabPane>
                                      <TabPane tab="Images" key="4">
                                          <div className="row">
                                            <div className="col-sm-12 col-md-4">
                                              {previewImg_descimg_1}
                                              {dropzone_descimg_1}
                                            </div>
                                            <div className="col-sm-12 col-md-4">
                                              {previewImg_descimg_2}
                                              {dropzone_descimg_2}
                                            </div>
                                            <div className="col-sm-12 col-md-4">
                                              {previewImg_descimg_3}
                                              {dropzone_descimg_3}
                                            </div>
                                          </div>
                                          <div className="row">
                                            <div className="col-sm-12 col-md-4">
                                              {previewImg_descimg_4}
                                              {dropzone_descimg_4}
                                            </div>
                                            <div className="col-sm-12 col-md-4">
                                              {previewImg_descimg_5}
                                              {dropzone_descimg_5}
                                            </div>
                                            <div className="col-sm-12 col-md-4">
                                              {previewImg_descimg_6}
                                              {dropzone_descimg_6}
                                            </div>
                                          </div>
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
