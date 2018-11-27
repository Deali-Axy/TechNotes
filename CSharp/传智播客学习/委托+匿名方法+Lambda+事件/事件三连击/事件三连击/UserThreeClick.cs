using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Drawing;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace 事件三连击
{
    public partial class UserThreeClick : UserControl
    {
        private int num = 0;
        //定义事件
        public event Action act;
        public UserThreeClick()
        {
            InitializeComponent();
        }

        private void btn_Click(object sender, EventArgs e)
        {
            num++;
            if (num == 3)
            {
                if (this.act != null)
                    act(); //触发事件 
                num = 0;
            }
        }
    }
}
