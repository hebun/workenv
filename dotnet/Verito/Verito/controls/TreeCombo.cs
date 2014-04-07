using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Drawing;
using System.Data;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Windows.Media;

namespace Verito.controls
{
  public  partial class TreeCombo : ComboBox {

      int treeType=0;//1:kategori,2:ambar
                  ToolStripControlHost treeViewHost;
                  ToolStripDropDown dropDown;
                 DefineForm cbmethod;
                  public TreeCombo():base() {

                        TreeView treeView = new TreeView();
                        treeView.BorderStyle = BorderStyle.None;
                        treeView.AfterSelect += new TreeViewEventHandler(afterSelect);
                        treeView.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
                        treeViewHost = new ToolStripControlHost(treeView);

                        // create drop down and add it

                        dropDown = new ToolStripDropDown();
                        dropDown.Items.Add(treeViewHost);

                      

                  
                  } 
                  public void callback(DefineForm method)
                  {
                      this.cbmethod = method;
                  }
                  public void afterSelect(object sender, TreeViewEventArgs e)
                  {
                     // MessageBox.Show(e.Node.Name);
                      this.dropDown.Hide();
                    
                      cbmethod.callback(e.Node);
                  }
                  public void load()
                  {


                      treeType = 1;
                      DoVerito.loadCategory(TreeView);
                      TreeView.ExpandAll();
                      TreeView.Width = DropDownWidth + 250;
                      TreeView.Height = DropDownHeight + 100;
                  }
                  public void loadStock()
                  {

                      treeType = 2;
                      
                      DoVerito.loadStock(TreeView);
                      TreeView.ExpandAll();
                      TreeView.Width = DropDownWidth + 150;
                      TreeView.Height = DropDownHeight + 100;
                  }
             
                  public TreeView TreeView {
                        get { return treeViewHost.Control as TreeView; }
                  }

                  private void ShowDropDown() {
                        if (dropDown != null) {
                            Invalidate();
                           treeViewHost.Width = DropDownWidth+500;
                           treeViewHost.Height = 500;
                            dropDown.Show(this,this.treeType==1?-204:-135, this.Height);
                           
                        }
                  }

                  private const int WM_USER = 0x0400,
                                    WM_REFLECT = WM_USER + 0x1C00,
                                    WM_COMMAND = 0x0111,
                                    CBN_DROPDOWN = 7;

                  public static int HIWORD(int n) {
                        return (n >> 16) & 0xffff;
                  }

                  protected override void WndProc(ref Message m) {
                        if (m.Msg == ( WM_REFLECT + WM_COMMAND)) {
                              if (HIWORD((int)m.WParam) == CBN_DROPDOWN) {  
                                    ShowDropDown();
                                    return;

                              }
                        }
                        base.WndProc(ref m);
                  }

                
            }
      }

