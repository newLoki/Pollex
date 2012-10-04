class CreateUsers < ActiveRecord::Migration
  def change
    create_table :users do |t|
      t.integer :id
      t.string :surname
      t.string :lastname
      t.string :email
      t.date :birthdate

      t.timestamps
    end
  end
end
