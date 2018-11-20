import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button, Select, Table, List } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';

const femaleIC = window.location.origin + '/img/ic-female.png';
const maleIC = window.location.origin + '/img/ic-male.png';

const columns = [{
  title: '#',
  dataIndex: 'rank',
  key: 'rank',
}, {
  title: 'RUNNER',
  dataIndex: 'runner',
  key: 'runner',
  render: (text) => (
   <b>{text}</b>
 ),
}, {
  title: 'Gender',
  dataIndex: 'r_gender',
  key: 'r_gender',
  render: (text) => (
   <img src={text} />
 ),
}, {
  title: 'RESULT',
  dataIndex: 'result',
  key: 'result',
}];

class RankEn extends Component{

  constructor(){
    super();
    this.state = {
      rank: window.rank,
      race_category: window.race_category,
      gender: 'all',
      category: window.firstcategory,
      data: []
    }
  }

  componentDidMount() {
      this.updateTable();
  }

  updateTable() {

    let tabledata = []
    let j=1

    for(var i=0; i<rank.length; i++) {
      if(rank[i]['r_gender'] == 'female')
        var r_gender = window.location.origin + '/img/ic-female.png'
      if(rank[i]['r_gender'] == 'male')
        var r_gender = window.location.origin + '/img/ic-male.png'

      let runner = rank[i]['firstname'] + ' ' + rank[i]['lastname']
      let result = rank[i]['pace_min'] + '"' + rank[i]['pace_sec']

      tabledata.push({
        key: j,
        rank: j,
        r_gender: r_gender,
        runner: runner,
        result: result
      })
      j = j+1
    }

    this.setState({
      data : tabledata
    })

    console.log(tabledata)
  }

  createCategoryItems() {
    let category_items = [];
    let race_category = this.state.race_category;
    let items = category.split(',')

    for(var i=0; i<items.length; i++) {
      category_items.push(<option key={items[i]} value={items[i]}>{items[i]}</option>);
    }

    return category_items;
  }

  handleGenderChange(value) {
    console.log(`selected ${value}`);
  }

  handleCategoryChange(value) {
    console.log(`selected ${value}`);
  }

  render(){

    return(
      <div>
        <Select defaultValue={this.state.gender} style={{ width: 120 }} onChange={this.handleGenderChange}>
          <Option value="all">All</Option>
          <Option value="female">Female</Option>
          <Option value="male">Male</Option>
        </Select>

        <Select defaultValue={this.state.category} style={{ width: 120 }} onChange={this.handleCategoryChange}>
          {this.createCategoryItems()}
        </Select>

        <Table columns={columns} dataSource={this.state.data} />
      </div>
    )
  }

}

export default RankEn

if(document.getElementById('ranking-en')){
    ReactDOM.render(<RankEn />, document.getElementById('ranking-en'))
}
